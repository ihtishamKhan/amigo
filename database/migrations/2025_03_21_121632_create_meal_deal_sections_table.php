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
        Schema::create('meal_deal_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meal_deal_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('required')->default(true);
            $table->integer('number_of_selections')->default(1); // How many dropdowns to show
            $table->boolean('allow_same_selection')->default(true); // Can select same item twice?
            $table->integer('display_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_deal_sections');
    }
};
