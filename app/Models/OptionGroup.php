<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OptionGroup extends Model
{
    protected $fillable = [
        'name', 'is_required', 'min_selections', 'max_selections',
        'display_order', 'is_active'
    ];

    protected $casts = [
        'min_selections' => 'integer',
        'max_selections' => 'integer',
        'display_order' => 'integer',
    ];

    public function options()
    {
        return $this->hasMany(Option::class)
            ->where('is_active', true)
            ->orderBy('display_order');
    }

    // Products that directly use this option group (no variations)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_option_group')
            ->withPivot('display_order')
            ->withTimestamps();
    }
    
    // Variations that use this option group
    public function variations()
    {
        return $this->belongsToMany(ProductVariation::class, 'variation_option_group', 'option_group_id', 'product_variation_id')
            ->withPivot('display_order')
            ->withTimestamps();
    }
}
