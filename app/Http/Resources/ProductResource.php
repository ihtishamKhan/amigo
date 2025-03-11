<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'has_variations' => (bool)$this->has_variations,
            'price' => $this->when(!$this->has_variations, (float)$this->price),
            'is_featured' => (bool)$this->is_featured,
            'starting_price' => (float)$this->starting_price,
            
            // Include variations when they exist
            'variations' => $this->when($this->has_variations, function() {
                return $this->variations->map(function($variation) {
                    return [
                        'id' => $variation->id,
                        'name' => $variation->name,
                        'price' => (float)$variation->price,
                        'is_default' => (bool)$variation->is_default,
                        
                        // Include option groups for this variation
                        'option_groups' => OptionGroupResource::collection($variation->optionGroups),
                        
                        // Include addon categories for this variation
                        'addon_categories' => AddonCategoryResource::collection($variation->addonCategories),
                    ];
                });
            }, []),
            
            // Include option groups and addon categories for products without variations
            'option_groups' => $this->when(!$this->has_variations, function() {
                return OptionGroupResource::collection($this->optionGroups);
            }, []),
            
            'addon_categories' => $this->when(!$this->has_variations, function() {
                return AddonCategoryResource::collection($this->addonCategories);
            }, []),
        ];
    }
}

class OptionGroupResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'is_required' => (bool)$this->is_required,
            'min_selections' => $this->min_selections,
            'max_selections' => $this->max_selections,
            'display_order' => $this->display_order,
            'options' => OptionResource::collection($this->whenLoaded('options')),
        ];
    }
}

class OptionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => (float)$this->price,
            'is_default' => (bool)$this->is_default,
            'display_order' => $this->display_order,
        ];
    }
}

class AddonCategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'display_name' => $this->display_name,
            'is_required' => (bool)$this->is_required,
            'min_selections' => $this->min_selections,
            'max_selections' => $this->max_selections,
            'display_order' => $this->display_order,
            'addons' => AddonResource::collection($this->whenLoaded('addons')),
        ];
    }
}

class AddonResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => (float)$this->price,
            'is_default' => (bool)$this->is_default,
            'display_order' => $this->display_order,
        ];
    }
}