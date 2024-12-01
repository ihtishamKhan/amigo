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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('user_address_id')->constrained();
            $table->string('status');
            $table->decimal('subtotal', 8, 2);
            $table->decimal('delivery_fee', 8, 2);
            $table->decimal('total', 8, 2);
            $table->string('payment_method');
            $table->string('payment_status');
            $table->datetime('delivery_time');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
