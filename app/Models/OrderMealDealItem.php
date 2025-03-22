<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderMealDealItem extends Model
{
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
    
    public function section()
    {
        return $this->belongsTo(MealDealSection::class, 'meal_deal_section_id');
    }
}
