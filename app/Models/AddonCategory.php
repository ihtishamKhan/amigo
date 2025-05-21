<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddonCategory extends Model
{
    use HasFactory;

    protected $casts = [
        'min_selections' => 'integer',
        'max_selections' => 'integer',
        'display_order' => 'integer',
    ];

    public function addons()
    {
        return $this->hasMany(Addon::class)
            ->where('is_active', true)
            ->orderBy('display_order');
    }

    // Products that directly use this addon category (no variations)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_addon_category')
            ->withPivot('display_order')
            ->withTimestamps();
    }
    
    // Variations that use this addon category
    public function variations()
    {
        return $this->belongsToMany(ProductVariation::class, 'variation_addon_category', 'addon_category_id', 'product_variation_id')
            ->withPivot('display_order')
            ->withTimestamps();
    }
}
