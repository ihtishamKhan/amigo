<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductVariationResource;

class ProductResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'starting_from' => [
                'amount' => $this->variations->min('price'),
                'formatted' => "£{$this->variations->min('price')}"
            ],
            'variations' => ProductVariationResource::collection($this->variations),
            'image' => $this->image_url,
            // 'category' => [
            //     'id' => $this->category_id,
            //     'name' => $this->category->name
            // ],
            'is_featured' => $this->is_featured,
        ];
    }
}