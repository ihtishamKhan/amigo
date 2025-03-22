<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

// Base MealDeal resource with common attributes
abstract class BaseMealDealResource extends JsonResource
{
    protected function getBaseArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => [
                'amount' => $this->price,
                'formatted' => "£{$this->price}"
            ],
            'image' => $this->image_url,
            'is_active' => $this->is_active,
            'display_order' => $this->display_order,
        ];
    }
}