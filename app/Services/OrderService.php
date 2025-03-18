<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemOption;
use App\Models\OrderItemAddon;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\Option;
use App\Models\Addon;
use App\Models\MealDeal;
use App\Enums\OrderType;
use App\Enums\OrderStatus;
use App\Events\OrderCreated;
use Illuminate\Support\Facades\DB;

class OrderService
{
    private $stripeService;

    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    public function createOrder(array $data)
    {
        return DB::transaction(function () use ($data) {
            $subtotal = $this->calculateSubtotal($data);
            $deliveryFee = $data['order_type'] === OrderType::DELIVERY->value 
                ? $this->calculateDeliveryFee() 
                : 0;
            $total = $subtotal + $deliveryFee;

            // Create Stripe Payment Intent
            $paymentIntent = $this->stripeService->createPaymentIntent(
                $total,
                'gbp', // or your currency
                $data['payment_method'],
                $data['payment_method_id']
            );

            // Handle guest vs authenticated user
            $orderData = [
                'order_type' => $data['order_type'],
                'status' => OrderStatus::CREATED,
                'payment_method' => $data['payment_method'],
                'pickup_delivery_time' => $data['pickup_delivery_time'],
                'notes' => $data['notes'] ?? null,
                'subtotal' => $subtotal,
                'delivery_fee' => $deliveryFee,
                'total' => $total,
                'stripe_payment_intent_id' => $paymentIntent->id,
                'stripe_client_secret' => $paymentIntent->client_secret,
                'payment_status' => 'pending',
            ];

            // Add user information based on auth status
            if (auth()->check()) {
                $orderData['user_id'] = auth()->id();
            } else {
                $orderData['guest_email'] = $data['guest_email'];
                $orderData['guest_name'] = $data['guest_name'];
                $orderData['guest_phone'] = $data['guest_phone'];
            }

            // Handle delivery specific data
            if ($data['order_type'] === OrderType::DELIVERY->value) {
                $orderData['delivery_address'] = $data['address'];
                $orderData['delivery_fee'] = $this->calculateDeliveryFee();
            }

            $order = Order::create($orderData);

            $this->createOrderItems($order, $data);

            // OrderCreated::dispatch($order);

            return $order;
        });
    }

    private function calculateSubtotal(array $data): float
    {
        $subtotal = 0;

        // Calculate products subtotal with variations, options, and addons
        if (!empty($data['products'])) {
            foreach ($data['products'] as $productData) {
                $product = Product::findOrFail($productData['product_id']);
                $itemPrice = $product->price;
                
                // If this product has a variation
                if (isset($productData['variation_id']) && $productData['variation_id']) {
                    $variation = ProductVariation::findOrFail($productData['variation_id']);
                    $itemPrice = $variation->price;
                }
                
                // Add option prices
                if (!empty($productData['option_groups'])) {
                    foreach ($productData['option_groups'] as $optionGroupData) {
                        foreach ($optionGroupData['options'] as $optionId) {
                            $option = Option::findOrFail($optionId);
                            $itemPrice += $option->price;
                        }
                    }
                }
                
                // Add addon prices (with variation-specific pricing if applicable)
                if (!empty($productData['addon_categories'])) {
                    foreach ($productData['addon_categories'] as $addonCategoryData) {
                        foreach ($addonCategoryData['addons'] as $addonId) {
                            $addon = Addon::findOrFail($addonId);
                            $addonPrice = $addon->price;
                            
                            // Check if there's a specific price for this variation/addon combination
                            // if (isset($productData['variation_id']) && $productData['variation_id']) {
                            //     $specificPrice = DB::table('product_addon_category_variants')
                            //         ->where('product_variation_id', $productData['variation_id'])
                            //         ->where('addon_id', $addon->id)
                            //         ->value('price');
                                    
                            //     if ($specificPrice !== null) {
                            //         $addonPrice = $specificPrice;
                            //     }
                            // }
                            
                            $itemPrice += $addonPrice;
                        }
                    }
                }
                
                $subtotal += $itemPrice * $productData['quantity'];
            }
        }

        // Calculate meal deals subtotal
        if (!empty($data['meal_deals'])) {
            foreach ($data['meal_deals'] as $item) {
                $mealDeal = MealDeal::findOrFail($item['meal_deal_id']);
                $subtotal += $mealDeal->price * $item['quantity'];
            }
        }

        return $subtotal;
    }

    private function createOrderItems($order, $data)
    {
        // Process regular products with variations, options, and addons
        if (!empty($data['products'])) {
            foreach ($data['products'] as $productData) {
                $product = Product::findOrFail($productData['product_id']);
                $basePrice = $product->price;
                $variation = null;
                
                // If this product has a variation
                if (isset($productData['variation_id']) && $productData['variation_id']) {
                    $variation = ProductVariation::findOrFail($productData['variation_id']);
                    $basePrice = $variation->price;
                }
                
                // Create the order item with polymorphic relationship
                $orderItem = $order->orderItems()->create([
                    'orderable_id' => $product->id,
                    'orderable_type' => Product::class,
                    'quantity' => $productData['quantity'],
                    'unit_price' => $basePrice,
                    'subtotal' => $basePrice * $productData['quantity'],
                    'product_variation_id' => $variation ? $variation->id : null
                ]);
                
                // Calculate the total item price including all options and addons
                $totalItemPrice = $basePrice;
                
                // Add selected options
                if (!empty($productData['option_groups'])) {
                    foreach ($productData['option_groups'] as $optionGroupData) {
                        foreach ($optionGroupData['options'] as $optionId) {
                            $option = Option::findOrFail($optionId);
                            
                            OrderItemOption::create([
                                'order_item_id' => $orderItem->id,
                                'option_id' => $option->id,
                                'option_group_id' => $optionGroupData['option_group_id'],
                                // 'price' => $option->price,
                                'price' => 12,
                                'name' => $option->name,
                            ]);
                            
                            // Add option price to the total
                            $totalItemPrice += $option->price;
                        }
                    }
                }
                
                // Add selected addons
                if (!empty($productData['addon_categories'])) {
                    foreach ($productData['addon_categories'] as $addonCategoryData) {
                        foreach ($addonCategoryData['addons'] as $addonId) {
                            $addon = Addon::findOrFail($addonId);
                            $addonPrice = $addon->price;
                            
                            // Check if there's a specific price for this variation/addon combination
                            // if ($variation) {
                            //     $specificPrice = DB::table('product_addon_category_variants')
                            //         ->where('product_variation_id', $variation->id)
                            //         ->where('addon_id', $addon->id)
                            //         ->value('price');
                                    
                            //     if ($specificPrice !== null) {
                            //         $addonPrice = $specificPrice;
                            //     }
                            // }
                            
                            OrderItemAddon::create([
                                'order_item_id' => $orderItem->id,
                                'addon_id' => $addon->id,
                                'addon_category_id' => $addonCategoryData['addon_category_id'],
                                'price' => $addonPrice,
                                'name' => $addon->name,
                            ]);
                            
                            // Add addon price to the total
                            $totalItemPrice += $addonPrice;
                        }
                    }
                }
                
                // Update the order item with the calculated total price
                $orderItem->update([
                    'subtotal' => $totalItemPrice * $productData['quantity']
                ]);
            }
        }

        // Process meal deals (keeping existing logic)
        if (!empty($data['meal_deals'])) {
            foreach ($data['meal_deals'] as $item) {
                $mealDeal = MealDeal::findOrFail($item['meal_deal_id']);
                $itemSubtotal = $mealDeal->price * $item['quantity'];

                $order->orderItems()->create([
                    'orderable_id' => $mealDeal->id,
                    'orderable_type' => MealDeal::class,
                    'quantity' => $item['quantity'],
                    'unit_price' => $mealDeal->price,
                    'subtotal' => $itemSubtotal
                ]);
            }
        }
    }

    private function calculateDeliveryFee()
    {
        // Your delivery fee calculation logic
        return 5.00;
    }
}