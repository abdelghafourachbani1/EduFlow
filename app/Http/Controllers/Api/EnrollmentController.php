<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EnrollmentService;

class EnrollmentController extends Controller
{
    protected $service;

    public function __construct(EnrollmentService $service) {
        $this->middleware('auth:api');
        $this->service = $service;
    }

    public function enroll($courseId) {
        return response()->json($this->service->enroll($courseId));
    }

    public function withdraw($courseId) {
        return response()->json($this->service->withdraw($courseId));
    }
}
