<?php

namespace App\Services;
use App\Models\Order;

class OrderService
{
    public function createOrder(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Handle guest vs authenticated user
            $orderData = [
                'order_type' => $data['order_type'],
                'status' => OrderStatus::PENDING,
                'payment_method' => $data['payment_method'],
                'payment_status' => 'pending',
                'pickup_delivery_time' => $data['pickup_delivery_time'],
                'notes' => $data['notes'] ?? null
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
                $orderData['address_id'] = $data['address_id'];
                $orderData['delivery_fee'] = $this->calculateDeliveryFee();
            }

            $order = Order::create($orderData);

            // Process items (same as before)
            $subtotal = $this->processOrderItems($order, $data);

            // Calculate total
            $total = $subtotal;
            if ($order->order_type === OrderType::DELIVERY->value) {
                $total += $order->delivery_fee;
            }

            $order->update([
                'subtotal' => $subtotal,
                'total' => $total
            ]);

            OrderCreated::dispatch($order);

            return $order;
        });
    }

    private function processOrderItems($order, $data)
    {
        $subtotal = 0;

        // Process regular products
        if (!empty($data['products'])) {
            foreach ($data['products'] as $item) {
                $product = Product::findOrFail($item['product_id']);
                $itemSubtotal = $product->price * $item['quantity'];
                $subtotal += $itemSubtotal;

                $order->items()->create([
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

                $order->items()->create([
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