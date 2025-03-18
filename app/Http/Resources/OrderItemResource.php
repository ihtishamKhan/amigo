<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    public function toArray($request): array
    {
        // Common properties for both product and meal deal items
        $result = [
            'id' => $this->id,
            'quantity' => $this->quantity,
            'unit_price' => [
                'amount' => $this->unit_price,
                'formatted' => "£{$this->unit_price}"
            ],
            'subtotal' => [
                'amount' => $this->subtotal,
                'formatted' => "£{$this->subtotal}"
            ],
        ];
        
        // Add product-specific properties
        if ($this->isProduct()) {
            $result['type'] = 'product';
            $result['name'] = $this->orderable->name;
            $result['product_id'] = $this->orderable_id;
            
            // Add variation details if applicable
            if ($this->product_variation_id) {
                $result['variation'] = [
                    'id' => $this->productVariation->id,
                    'name' => $this->productVariation->name,
                ];
            }
            
            // Add options and addons
            $result['options'] = $this->when($this->orderItemOptions->count() > 0, 
                OrderItemOptionResource::collection($this->orderItemOptions)
            );
            
            $result['addons'] = $this->when($this->orderItemAddons->count() > 0, 
                OrderItemAddonResource::collection($this->orderItemAddons)
            );
        } 
        // Add meal deal-specific properties
        else if ($this->isMealDeal()) {
            $result['type'] = 'meal_deal';
            $result['name'] = $this->orderable->name;
            $result['meal_deal_id'] = $this->orderable_id;
        }
        
        return $result;
    }
}

class OrderItemOptionResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'option_group' => [
                'id' => $this->option_group_id,
                'name' => $this->optionGroup->name,
            ],
            'price' => [
                'amount' => $this->price,
                'formatted' => "£{$this->price}"
            ],
        ];
    }
}

class OrderItemAddonResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'addon_category' => [
                'id' => $this->addon_category_id,
                'name' => $this->addonCategory->name,
            ],
            'price' => [
                'amount' => $this->price,
                'formatted' => "£{$this->price}"
            ],
        ];
    }
}