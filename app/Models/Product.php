<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Define the active scope
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Define the featured scope
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute()
    {
        if(!$this->image) {
            return null;
        }

        return asset('storage/products/' . $this->image);
    }
}
