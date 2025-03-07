<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProductVariationResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'category_id' => $this->category_id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'image' => $this->image ? asset('storage/' . $this->image) : null,
            'has_sizes' => (bool)$this->has_sizes,
            'has_addons' => (bool)$this->has_addons,
            'is_featured' => (bool)$this->is_featured,
            'starting_from' => (float)$this->variations->min('price'),
            
            // Include variations when they exist
            'variations' => $this->when($this->has_sizes, function() {
                return $this->variations->map(function($variation) {
                    return [
                        'id' => $variation->id,
                        'name' => $variation->name,
                        'price' => (float)$variation->price,
                        'is_default' => (bool)$variation->is_default,
                        'addon_categories' => $this->when(
                            isset($this->variantAddonCategories) && 
                            isset($this->variantAddonCategories[$variation->id]), 
                            function() use ($variation) {
                                return $this->variantAddonCategories[$variation->id]->map(function($acv) {
                                    return [
                                        'id' => $acv->addonCategory->id,
                                        'name' => $acv->addonCategory->name,
                                        'is_required' => (bool)$acv->addonCategory->is_required,
                                        'min_selections' => $acv->addonCategory->min_selections,
                                        'max_selections' => $acv->addonCategory->max_selections,
                                        'price_multiplier' => (float)$acv->price_multiplier,
                                        'addons' => $acv->addonCategory->addons->map(function($addon) use ($acv) {
                                            return [
                                                'id' => $addon->id,
                                                'name' => $addon->name,
                                                'price' => (float)($addon->price * $acv->price_multiplier),
                                            ];
                                        }),
                                    ];
                                });
                            },
                            []
                        )
                    ];
                });
            }, []),

            // Include global addon categories (those not tied to variations)
            'global_addon_categories' => $this->when($this->has_addons, function() {
                return $this->addonCategories->map(function($category) {
                    return [
                        'id' => $category->id,
                        'name' => $category->name,
                        'is_required' => (bool)$category->is_required,
                        'min_selections' => $category->min_selections,
                        'max_selections' => $category->max_selections,
                        'addons' => $category->addons->map(function($addon) {
                            return [
                                'id' => $addon->id,
                                'name' => $addon->name,
                                'price' => (float)$addon->price,
                            ];
                        }),
                    ];
                });
            }, []),
        ];
    }
}