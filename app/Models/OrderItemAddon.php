<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItemAddon extends Model
{
    protected $fillable = [
        'order_item_id',
        'addon_id',
        'addon_category_id',
        'price',
        'name',
    ];

    /**
     * Get the order item that owns the addon.
     */
    public function orderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class);
    }

    /**
     * Get the addon.
     */
    public function addon(): BelongsTo
    {
        return $this->belongsTo(Addon::class);
    }

    /**
     * Get the addon category.
     */
    public function addonCategory(): BelongsTo
    {
        return $this->belongsTo(AddonCategory::class);
    }
}
