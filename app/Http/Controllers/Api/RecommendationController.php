<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\RecommendationService;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    protected $service;

    public function __construct(RecommendationService $service) {
        $this->middleware('auth:api');
        $this->service = $service;
    }

    public function index() {
        return response()->json($this->service->getRecommendedCourses());
    }
}
