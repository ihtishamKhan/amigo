<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class MealDeal extends Model
{
    use HasFactory, Sluggable;

    protected $casts = [
        'is_active' => 'integer',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    // Define the active scope
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function sections()
    {
        return $this->hasMany(MealDealSection::class);
    }
    
    public function orderItems()
    {
        return $this->morphMany(OrderItem::class, 'orderable');
    }

    public function getImageUrlAttribute()
    {
        if(!$this->image) {
            return null;
        }

        return asset('storage/products/' . $this->image);
    }
}
