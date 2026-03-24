<?php

namespace App\Services;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Course;

class StripeService {

    public function createCheckoutSession($courseId) {
        Stripe::setApiKey(config('services.stripe.ssecret'));

        $course = Course::findOrFail($courseId);

        return Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $course->title,
                    ],
                    'unit_amount' => $course->price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/api/payment/success/'.$courseId),
            'cancel_url' => url('/api/payment/cancel'),
        ]);
    } 

}