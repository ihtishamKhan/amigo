<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BaseMealDealResource;

// Base MealDeal resource with common attributes
class MealDealDetailResource extends BaseMealDealResource
{
    public function toArray($request): array
    {
        return array_merge($this->getBaseArray(), [
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'savings' => $this->calculateSavings()
        ]);
    }

    private function calculateSavings()
    {
        $originalPrice = $this->products->sum(function ($product) {
            return $product->price * $product->pivot->quantity;
        });
        
        return $originalPrice - $this->price;
    }
}
