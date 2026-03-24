<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\StripeService;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    protected $stripe;

    public function __construct(StripeService $stripe) {
        $this->middlware('auth:api');
        $this->stripe = $stripe;
    }

    public function pay($courseId) {
        $session = $this->stripe->createCheckoutSession($courseId);
        
        return response()->json([
            'url' => $session->url
        ]);
    }


}
