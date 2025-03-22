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
        Schema::create('order_meal_deal_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_item_id')->constrained()->onDelete('cascade');
            $table->foreignId('meal_deal_section_id')->constrained()->onDelete('cascade');
            $table->string('reference_type'); // 'product', 'variation', 'option'
            $table->unsignedBigInteger('reference_id');
            $table->string('name');
            $table->decimal('price', 8, 2)->default(0.00);
            $table->integer('quantity')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_meal_deal_items');
    }
};
