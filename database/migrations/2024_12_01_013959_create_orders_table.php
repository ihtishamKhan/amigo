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
            $table->uuid('uuid')->unique();
            $table->foreignId('user_id')->nullable()->constrained(); // Made nullable for guest orders
            $table->string('guest_email')->nullable();
            $table->string('guest_name')->nullable();
            $table->string('guest_phone')->nullable();
            $table->string('order_type'); // 'delivery' or 'pickup'
            $table->foreignId('address_id')->nullable();
            $table->string('status');
            $table->decimal('subtotal', 8, 2)->default(0);
            $table->decimal('delivery_fee', 8, 2)->nullable();
            $table->decimal('total', 8, 2)->default(0);
            $table->string('payment_method');
            $table->string('stripe_payment_intent_id')->nullable();
            $table->string('stripe_client_secret')->nullable();
            $table->string('payment_status');
            $table->datetime('pickup_delivery_time');
            $table->text('notes')->nullable();
            $table->json('delivery_address')->nullable();
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
