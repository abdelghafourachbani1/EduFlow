<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CourseService;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService) {
        $this->courseService = $courseService;
        $this->middleware('auth:api');
    }

    public function index() {
        return response()->json($this->courseService->listCourse());
    }

    public function show($id) {
        return response()->json($this->courseService->getCourse($id));
    }

    public function store(Request $request) {
        $data = $request->only(['title','description','price']);
        return response()->json($this->courseService->createCourse($data));
    }

    public function update(Request $request , $id) {
        $data = $request->only(['title','description','price']);
        return response()->json($this->courseService->updateCourse($id , $data));
    } 

    public function destroy($id) {
        return response()->json($this->courseService->deleteCourse($id));
    }
}
