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
        Schema::create('meal_deal_section_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meal_deal_section_id')->constrained()->onDelete('cascade');
            $table->string('reference_type'); // 'product', 'variation', 'option'
            $table->unsignedBigInteger('reference_id');
            $table->string('name_override')->nullable();
            $table->decimal('price_override', 8, 2)->nullable();
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_deal_section_items');
    }
};
