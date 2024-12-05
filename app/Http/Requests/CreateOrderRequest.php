<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Enums\OrderType;

class CreateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'order_type' => ['required', 'string', Rule::in([
                OrderType::DELIVERY->value,
                OrderType::PICKUP->value
            ])],
            'payment_method' => 'required|in:card,apple_pay',
            'pickup_delivery_time' => 'required|date|after:now',
            'notes' => 'nullable|string|max:500',
            'products' => 'array|nullable',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'meal_deals' => 'array|nullable',
            'meal_deals.*.meal_deal_id' => 'required|exists:meal_deals,id',
            'meal_deals.*.quantity' => 'required|integer|min:1',
        ];

        // Add guest-specific rules if not authenticated
        if (!auth()->check()) {
            $rules['guest_email'] = 'required|email';
            $rules['guest_name'] = 'required|string|max:255';
            $rules['guest_phone'] = 'required|string|max:20';
        }

        // Add delivery-specific rules
        if ($this->input('order_type') === OrderType::DELIVERY->value) {
            $rules['address_id'] = 'required|exists:user_addresses,id';
        }

        return $rules;
    }
}
