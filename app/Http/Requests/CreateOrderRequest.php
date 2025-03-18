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
            'payment_method_id' => 'required|string',
            'pickup_delivery_time' => 'required|date|after:now',
            'notes' => 'nullable|string|max:500',
            
            // Updated products with variations, options and addons
            'products' => 'array|nullable',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.variation_id' => 'nullable|exists:product_variations,id',
            
            // Options (multiple/single free/paid)
            'products.*.option_groups' => 'array|nullable',
            'products.*.option_groups.*.option_group_id' => 'required|exists:option_groups,id',
            'products.*.option_groups.*.options' => 'array|required',
            'products.*.option_groups.*.options.*' => 'required|exists:options,id',
            
            // Addons with different prices for variations
            'products.*.addon_categories' => 'array|nullable',
            'products.*.addon_categories.*.addon_category_id' => 'required|exists:addon_categories,id',
            'products.*.addon_categories.*.addons' => 'array|required',
            'products.*.addon_categories.*.addons.*' => 'required|exists:addons,id',
            
            // Keep meal deals as before
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
            $rules['address'] = 'required|array';
            $rules['address.line1'] = 'required|string|max:255';
            $rules['address.line2'] = 'nullable|string|max:255';
            $rules['address.city'] = 'required|string|max:255';
            $rules['address.state'] = 'required|string|max:255';
            $rules['address.postcode'] = 'required|string|max:20';
            $rules['address.latitude'] = 'nullable|numeric';
            $rules['address.longitude'] = 'nullable|numeric';
        }

        return $rules;
    }
}