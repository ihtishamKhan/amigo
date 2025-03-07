<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => [
                'amount' => $this->price,
                'formatted' => "£{$this->price}"
            ],
            'addons' => $this->addons->map(function ($addon) {
                return [
                    'id' => $addon->id,
                    'name' => $addon->name,
                    'price' => [
                        'amount' => $addon->pivot->price_multiplier,
                        'formatted' => "£{$addon->pivot->price_multiplier}"
                    ]
                ];
            }),
        ];
    }
}
