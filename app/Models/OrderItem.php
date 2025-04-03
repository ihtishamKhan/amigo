<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'orderable_id', 'orderable_type', 
        'quantity', 'unit_price', 'subtotal', 'product_variation_id'
    ];

    /**
     * Get the order that owns the item.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function orderable()
    {
        return $this->morphTo();
    }

    /**
     * Get the product variation for this item.
     */
    public function productVariation(): BelongsTo
    {
        return $this->belongsTo(ProductVariation::class);
    }

    /**
     * Get the options for this item.
     */
    public function orderItemOptions(): HasMany
    {
        return $this->hasMany(OrderItemOption::class);
    }

    /**
     * Get the addons for this item.
     */
    public function orderItemAddons(): HasMany
    {
        return $this->hasMany(OrderItemAddon::class);
    }
    
    /**
     * Determine if this item is a product.
     */
    public function isProduct(): bool
    {
        return $this->orderable_type === Product::class;
    }

    /**
     * Determine if this item is a meal deal.
     */
    public function isMealDeal(): bool
    {
        return $this->orderable_type === MealDeal::class;
    }

    // Meal deal selections (if this is a meal deal)
    public function mealDealItems()
    {
        return $this->hasMany(OrderMealDealItem::class);
    }
}
