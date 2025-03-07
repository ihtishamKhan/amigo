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
        Schema::create('product_addon_categories_variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('variant_id')->constrained('product_variations')->onDelete('cascade');
            $table->foreignId('addon_category_id')->constrained()->onDelete('cascade');
            $table->decimal('price_multiplier', 8, 2)->default(0); // The price for addons in this category for this variant
            $table->integer('display_order')->default(1);
            $table->timestamps();

            $table->unique(['product_id', 'variant_id', 'addon_category_id'], 'product_variant_addon_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_addon_categories_variants');
    }
};
