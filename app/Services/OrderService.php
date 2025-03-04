<?php

namespace App\Services;
use App\Models\Order;
use App\Models\Product;
use App\Models\MealDeal;
use App\Enums\OrderType;
use App\Enums\OrderStatus;
use App\Events\OrderCreated;
use Illuminate\Support\Facades\DB;
use App\Services\StripeService;

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
                // if(auth()->check()) {
                //     $orderData['address_id'] = $data['address_id'];
                // } else {
                //     $orderData['delivery_address'] = $data['address'];
                // }
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

        // Calculate products subtotal
        if (!empty($data['products'])) {
            foreach ($data['products'] as $item) {
                $product = Product::findOrFail($item['product_id']);
                $subtotal += $product->price * $item['quantity'];
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
        $subtotal = 0;

        // Process regular products
        if (!empty($data['products'])) {
            foreach ($data['products'] as $item) {
                $product = Product::findOrFail($item['product_id']);
                $itemSubtotal = $product->price * $item['quantity'];
                $subtotal += $itemSubtotal;

                $order->orderItems()->create([
                    'orderable_id' => $product->id,
                    'orderable_type' => Product::class,
                    'quantity' => $item['quantity'],
                    'unit_price' => $product->price,
                    'subtotal' => $itemSubtotal
                ]);
            }
        }

        // Process meal deals
        if (!empty($data['meal_deals'])) {
            foreach ($data['meal_deals'] as $item) {
                $mealDeal = MealDeal::findOrFail($item['meal_deal_id']);
                $itemSubtotal = $mealDeal->price * $item['quantity'];
                $subtotal += $itemSubtotal;

                $order->orderItems()->create([
                    'orderable_id' => $mealDeal->id,
                    'orderable_type' => MealDeal::class,
                    'quantity' => $item['quantity'],
                    'unit_price' => $mealDeal->price,
                    'subtotal' => $itemSubtotal
                ]);
            }
        }

        return $subtotal;
    }

    private function calculateDeliveryFee()
    {
        // Your delivery fee calculation logic
        return 5.00;
    }
}