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
        'payment_status', 'delivery_time', 'notes', 'order_type', 'pickup_delivery_time', 'guest_email', 'guest_name', 'guest_phone', 'delivery_address'
    ];

    protected $casts = [
        'delivery_address' => 'array',
        'pickup_delivery_time' => 'datetime'
    ];

    protected $dates = [
        'pickup_delivery_time'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class)->with('orderable');
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'orderable', 'order_items');
    }

    public function mealDeals()
    {
        return $this->morphedByMany(MealDeal::class, 'orderable', 'order_items');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCustomerNameAttribute()
    {
        return $this->user_id ? $this->user->name : $this->guest_name;
    }

    public function getCustomerEmailAttribute()
    {
        return $this->user_id ? $this->user->email : $this->guest_email;
    }

    public function getCustomerPhoneAttribute()
    {
        return $this->user_id ? $this->user->phone : $this->guest_phone;
    }

    public function address()
    {
        return $this->belongsTo(UserAddress::class);
    }

    public function getFullAddressAttribute()
    {
        return $this->address->full_address ?? 
            $this->delivery_address['line1'] . ', ' . 
            $this->delivery_address['line2'] . ', ' . 
            $this->delivery_address['city'] . ', ' . 
            $this->delivery_address['postcode'];
    }
}
