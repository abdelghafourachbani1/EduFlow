<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\StripeService;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;
use App\Services\GroupService;


class PaymentController extends Controller
{

    protected $stripe;
    protected $groupService;

    public function __construct(StripeService $stripe , GroupService $groupService) {
        $this->middlware('auth:api');
        $this->stripe = $stripe;
        $this->groupService = $groupService;
    }

    public function pay($courseId) {
        $session = $this->stripe->createCheckoutSession($courseId);
        
        return response()->json([
            'url' => $session->url
        ]);
    }

    public function success($courseId) {
        Enrollment::updateOrCreate([
            'user_id' => Auth::id(),
            'course_id' => $courseId
        ]);

        return response()->json([
            'message' => 'Payment successful & enrolled'
        ]);
    }

    public function cancel() {
        return response()->json([
            'message' => 'Payment cancelled'
        ]);
    }

}
