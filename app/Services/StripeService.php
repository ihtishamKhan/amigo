<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\PaymentIntent;

class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    public function createPaymentIntent($amount, $currency = 'gbp', $paymentMethod = 'card', $paymentMethodId = null)
    {
        $paymentMethods = ['card'];
        if ($paymentMethod === 'apple_pay') {
            $paymentMethods[] = 'apple_pay';
        }

        $paymentIntent = PaymentIntent::create([
            'amount' => $amount * 100, // Convert to cents
            'currency' => $currency,
            'payment_method_types' => $paymentMethods,
            'payment_method' => $paymentMethodId,
            'capture_method' => 'automatic',
        ]);

        return $paymentIntent;
    }
}