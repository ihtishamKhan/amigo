<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BaseMealDealResource;

class MealDealListResource extends BaseMealDealResource
{
    public function toArray($request): array
    {
        return array_merge($this->getBaseArray(), [
            // Include a preview of what's in the meal deal
            'preview' => $this->getSectionPreview(),

            // Include full sections data
            'sections' => $this->whenLoaded('sections', function() {
                return $this->sections
                    ->sortBy('display_order')
                    ->map(function($section) {
                        return [
                            'id' => $section->id,
                            'name' => $section->name,
                            'description' => $section->description,
                            'required' => $section->required,
                            'number_of_selections' => $section->number_of_selections,
                            'allow_same_selection' => $section->allow_same_selection,
                            'display_order' => $section->display_order,
                            'items' => $this->getSectionItems($section),
                        ];
                    });
            }),
        ]);
    }

    private function getSectionPreview()
    {
        // Return a simplified representation of what's in the meal deal
        return $this->whenLoaded('sections', function() {
            return $this->sections
                ->sortBy('display_order')
                ->map(function($section) {
                    $itemCount = $section->number_of_selections;
                    $itemType = $section->name;
                    
                    if ($itemCount > 1) {
                        return "{$itemCount} x {$itemType}";
                    } elseif ($itemCount === 0 && $section->items->count() > 0) {
                        // For predetermined items
                        $item = $section->items->first();
                        return $item->name_override ?? $item->name ?? $section->name;
                    } else {
                        return $itemType;
                    }
                })
                ->implode(', ');
        }, "");
    }

    private function getSectionItems($section)
    {
        return $section->items()
            ->orderBy('display_order')
            ->get()
            ->map(function($item) {
                $reference = $this->getItemReference($item);
                
                return [
                    'id' => $item->id,
                    'reference_type' => $item->reference_type,
                    'reference_id' => $item->reference_id,
                    'name' => $item->name_override ?? $reference['name'] ?? '',
                    'description' => $reference['description'] ?? '',
                    'image' => $reference['image'] ?? null,
                    'price' => $item->price_override ?? $reference['price'] ?? 0,
                    'display_order' => $item->display_order,
                ];
            });
    }

    private function getItemReference($item)
    {
        // Get the actual referenced item details
        switch ($item->reference_type) {
            case 'product':
                $product = \App\Models\Product::find($item->reference_id);
                if ($product) {
                    return [
                        'name' => $product->name,
                        'description' => $product->description,
                        'image' => $product->image_url,
                        'price' => $product->price,
                    ];
                }
                break;
                
            case 'variation':
                $variation = \App\Models\ProductVariation::with('product')->find($item->reference_id);
                if ($variation && $variation->product) {
                    return [
                        'name' => $variation->product->name . ' (' . $variation->name . ')',
                        'description' => $variation->product->description,
                        'image' => $variation->product->image_url,
                        'price' => $variation->price,
                    ];
                }
                break;
                
            case 'option':
                $option = \App\Models\Option::find($item->reference_id);
                if ($option) {
                    return [
                        'name' => $option->name,
                        'description' => '',
                        'image' => null,
                        'price' => $option->price,
                    ];
                }
                break;
        }
        
        return [
            'name' => '',
            'description' => '',
            'image' => null,
            'price' => 0,
        ];
    }
}