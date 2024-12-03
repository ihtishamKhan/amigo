<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealDeal extends Model
{
    use HasFactory;

    // Define the active scope
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'meal_deal_products');
    }
}
