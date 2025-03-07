<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAddonCategoryVariant extends Model
{

    protected $table = 'product_addon_categories_variants';
    
    public function addonCategory()
    {
        return $this->belongsTo(AddonCategory::class);
    }
}
