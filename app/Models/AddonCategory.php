<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddonCategory extends Model
{
    use HasFactory;

    // Relationship to access product variants that use this addon category
    public function addons()
    {
        return $this->hasMany(Addon::class);
    }
}
