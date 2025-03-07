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

    public function addonCategories()
    {
        return $this->belongsToMany(AddonCategory::class, 'product_addon_categories')
                    ->withPivot('display_order')
                    ->withTimestamps();
    }
}
