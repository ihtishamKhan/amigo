<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'address_id', 'status', 'subtotal', 
        'delivery_fee', 'total', 'payment_method', 
        'payment_status', 'delivery_time', 'notes', 'order_type', 'pickup_delivery_time', 'guest_email', 'guest_name', 'guest_phone'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'orderable', 'order_items');
    }

    public function mealDeals()
    {
        return $this->morphedByMany(MealDeal::class, 'orderable', 'order_items');
    }
}
