<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\WishlistService;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    protected $service;

    public function __construct(WishlistService $service) {
        $this->middleware('auth:api');
        $this->service = $service;
    }

    public function add($courseId) {
        return response()->json($this->service->add($courseId));
    }

    public function remove($courseId) {
        return response()->json($this->service->remove($courseId));
    }

    public function index() {
        return response()->json($this->service->list());
    }
    
}
