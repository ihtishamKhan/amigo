<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_item_components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_item_id')->constrained()->onDelete('cascade');
            $table->foreignId('component_group_id')->nullable()->constrained('meal_deal_component_groups');
            $table->morphs('selectable'); // What was selected (product_id, product_variant_id)
            $table->integer('quantity')->default(1);
            $table->decimal('price_adjustment', 8, 2)->default(0.00);
            $table->json('selected_addons')->nullable(); // For addons on components
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item_components');
    }
};
