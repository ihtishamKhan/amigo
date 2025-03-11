<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    use HasFactory;

    protected $fillable = [
        'addon_category_id', 'name', 'price', 'is_default',
        'display_order', 'is_active'
    ];

    public function addonCategory()
    {
        return $this->belongsTo(AddonCategory::class);
    }
}
