<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Option groups for this variation
    public function optionGroups()
    {
        return $this->belongsToMany(OptionGroup::class, 'variation_option_group', 'product_variation_id', 'option_group_id')
            ->withPivot('display_order')
            ->orderBy('pivot_display_order')
            ->where('is_active', true)
            ->withTimestamps();
    }
    
    // Addon categories for this variation
    public function addonCategories()
    {
        return $this->belongsToMany(AddonCategory::class, 'variation_addon_category', 'product_variation_id', 'addon_category_id')
            ->withPivot('display_order')
            ->orderBy('pivot_display_order')
            ->where('is_active', true)
            ->withTimestamps();
    }

}
