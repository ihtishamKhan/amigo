<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealDealSection extends Model
{
    protected $casts = [
        'number_of_selections' => 'integer',
        'allow_same_selection' => 'integer',
        'display_order' => 'integer',
        'required' => 'integer',
    ];
    
    public function mealDeal()
    {
        return $this->belongsTo(MealDeal::class);
    }
    
    public function items()
    {
        return $this->hasMany(MealDealSectionItem::class);
    }
}
