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
        // Products to Option Groups (for products without variations)
        Schema::create('product_option_group', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('option_group_id')->constrained()->onDelete('cascade');
            $table->integer('display_order')->default(0);
            $table->timestamps();
            
            // Specify a shorter name for the unique constraint
            $table->unique(['product_id', 'option_group_id'], 'prod_opt_group_unique');
        });
        
        // Products to Addon Categories (for products without variations)
        Schema::create('product_addon_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('addon_category_id')->constrained()->onDelete('cascade');
            $table->integer('display_order')->default(0);
            $table->timestamps();
            
            // Specify a shorter name for the unique constraint
            $table->unique(['product_id', 'addon_category_id'], 'prod_addon_cat_unique');
        });
        
        // Variations to Option Groups
        Schema::create('variation_option_group', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variation_id')->constrained()->onDelete('cascade');
            $table->foreignId('option_group_id')->constrained()->onDelete('cascade');
            $table->integer('display_order')->default(0);
            $table->timestamps();
            
            // Specify a shorter name for the unique constraint
            $table->unique(['product_variation_id', 'option_group_id'], 'var_opt_group_unique');
        });
        
        // Variations to Addon Categories
        Schema::create('variation_addon_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_variation_id')->constrained()->onDelete('cascade');
            $table->foreignId('addon_category_id')->constrained()->onDelete('cascade');
            $table->integer('display_order')->default(0);
            $table->timestamps();
            
            // Specify a shorter name for the unique constraint
            $table->unique(['product_variation_id', 'addon_category_id'], 'var_addon_cat_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variation_addon_category');
        Schema::dropIfExists('variation_option_group');
        Schema::dropIfExists('product_addon_category');
        Schema::dropIfExists('product_option_group');
    }
};