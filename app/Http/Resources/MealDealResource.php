<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class MealDealResource extends JsonResource
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
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'savings' => $this->calculateSavings() // Original prices - deal price
        ];
    }

    private function calculateSavings()
    {
        $originalPrice = $this->products->sum(function ($product) {
            return $product->price * $product->pivot->quantity;
        });
        
        return $originalPrice - $this->price;
    }
}