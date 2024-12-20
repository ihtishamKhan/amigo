<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_line1',
        'address_line2',
        'city',
        'postcode',
        'latitude',
        'longitude',
        'is_default'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function getFullAddressAttribute()
    {
        return "{$this->address_line1}, {$this->address_line2}, {$this->city}, {$this->postcode}";
    }
}
