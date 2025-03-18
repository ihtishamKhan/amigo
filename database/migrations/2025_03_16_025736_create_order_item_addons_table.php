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
        Schema::create('order_item_addons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_item_id');
            $table->unsignedBigInteger('addon_id');
            $table->unsignedBigInteger('addon_category_id');
            $table->decimal('price', 8, 2);
            $table->string('name');
            $table->timestamps();
            
            $table->foreign('order_item_id')
                  ->references('id')
                  ->on('order_items')
                  ->onDelete('cascade');
                  
            $table->foreign('addon_id')
                  ->references('id')
                  ->on('addons')
                  ->onDelete('cascade');
                  
            $table->foreign('addon_category_id')
                  ->references('id')
                  ->on('addon_categories')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item_addons');
    }
};
