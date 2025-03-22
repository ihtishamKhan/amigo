<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MealDealSectionItem extends Model
{
    public function section()
    {
        return $this->belongsTo(MealDealSection::class, 'meal_deal_section_id');
    }
    
    public function reference()
    {
        return $this->morphTo();
    }
}
