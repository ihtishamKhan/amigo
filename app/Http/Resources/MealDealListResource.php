<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BaseMealDealResource;

// Base MealDeal resource with common attributes
class MealDealListResource extends BaseMealDealResource
{
    public function toArray($request): array
    {
        return array_merge($this->getBaseArray(), []);
        // return array_merge($this->getBaseArray(), [
        //     'savings' => $this->calculateSavings()
        // ]);
    }

    private function calculateSavings()
    {
        return $this->whenLoaded('products', function() {
            $originalPrice = $this->products->sum(function ($product) {
                return $product->price * $product->pivot->quantity;
            });
            
            return $originalPrice - $this->price;
        }, 0);
    }
}
