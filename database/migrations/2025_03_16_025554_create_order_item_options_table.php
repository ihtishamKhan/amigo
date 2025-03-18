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
        Schema::create('order_item_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_item_id');
            $table->unsignedBigInteger('option_id');
            $table->unsignedBigInteger('option_group_id');
            $table->decimal('price', 8, 2);
            $table->string('name');
            $table->timestamps();
            
            $table->foreign('order_item_id')
                  ->references('id')
                  ->on('order_items')
                  ->onDelete('cascade');
                  
            $table->foreign('option_id')
                  ->references('id')
                  ->on('options')
                  ->onDelete('cascade');
                  
            $table->foreign('option_group_id')
                  ->references('id')
                  ->on('option_groups')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_item_options');
    }
};
