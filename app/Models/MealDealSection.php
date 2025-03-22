<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealDealSection extends Model
{
    public function mealDeal()
    {
        return $this->belongsTo(MealDeal::class);
    }
    
    public function items()
    {
        return $this->hasMany(MealDealSectionItem::class);
    }
}
