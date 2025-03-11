<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory, Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    // Define the active scope
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Define the featured scope
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute()
    {
        if(!$this->image) {
            return null;
        }

        return asset('storage/products/' . $this->image);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    // Direct option groups (for products without variations)
    public function optionGroups()
    {
        return $this->belongsToMany(OptionGroup::class, 'product_option_group')
            ->withPivot('display_order')
            ->orderBy('pivot_display_order')
            ->where('is_active', true)
            ->withTimestamps();
    }
    
    // Direct addon categories (for products without variations)
    public function addonCategories()
    {
        return $this->belongsToMany(AddonCategory::class, 'product_addon_category')
            ->withPivot('display_order')
            ->orderBy('pivot_display_order')
            ->where('is_active', true)
            ->withTimestamps();
    }

    // Helper method to get starting price
    public function getStartingPriceAttribute()
    {
        if ($this->has_variations) {
            return $this->variations()->min('price') ?? 0;
        }
        
        return $this->price ?? 0;
    }
}
