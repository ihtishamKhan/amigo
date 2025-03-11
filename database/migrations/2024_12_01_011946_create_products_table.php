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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('has_variations')->default(false);
            $table->boolean('has_sizes')->default(false);
            $table->boolean('has_options')->default(false); // For crust types, flavors, etc.
            $table->boolean('has_addons')->default(false);  // For toppings, extras shown in your image
            $table->boolean('has_sides')->default(false);   // For side options (chips, salad)
            $table->boolean('has_sauces')->default(false);  // For sauce selections
            $table->decimal('price', 8, 2)->nullable();     // Base price for products without variations
            $table->integer('required_selections')->default(0); // Number of required selections for sides/sauces
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
