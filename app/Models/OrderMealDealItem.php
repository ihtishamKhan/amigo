<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderMealDealItem extends Model
{
    protected $fillable = [
        'order_item_id', 'meal_deal_section_id', 'reference_type', 
        'reference_id', 'name', 'price'
    ];
    
    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class);
    }
    
    public function section()
    {
        return $this->belongsTo(MealDealSection::class, 'meal_deal_section_id');
    }

    // Polymorphic relationship to the selected item
    public function reference()
    {
        return $this->morphTo();
    }
}
