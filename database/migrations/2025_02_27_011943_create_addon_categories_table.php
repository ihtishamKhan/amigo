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
        Schema::create('addon_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "10" Toppings", "12" Toppings", etc.
            $table->string('display_name')->nullable(); // User-friendly name shown in UI, e.g., "Fancy a little something extra?"
            $table->boolean('is_required')->default(false);
            $table->integer('min_selections')->default(0);
            $table->integer('max_selections')->default(0); // 0 means unlimited
            $table->integer('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addon_categories');
    }
};
