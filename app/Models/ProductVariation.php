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

    public function addonCategoriesVariants()
    {
        return $this->hasMany(ProductAddonCategoryVariant::class, 'variant_id');
    }

}
