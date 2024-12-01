<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
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
            'category' => [
                'id' => $this->category_id,
                'name' => $this->category->name
            ],
            'is_featured' => $this->is_featured,
            'is_meal_deal' => $this->is_meal_deal
        ];
    }
}