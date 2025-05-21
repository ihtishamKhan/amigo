<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $casts = [
        'display_order' => 'integer',
    ];

    public function optionGroup()
    {
        return $this->belongsTo(OptionGroup::class);
    }
}
