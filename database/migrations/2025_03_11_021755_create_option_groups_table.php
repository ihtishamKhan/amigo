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
        Schema::create('option_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "10" Crust Options", "Kebab Sides", etc.
            $table->boolean('is_required')->default(false);
            $table->integer('min_selections')->default(0);
            $table->integer('max_selections')->default(1); // 1 for single select, >1 for multi-select
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
        Schema::dropIfExists('option_groups');
    }
};
