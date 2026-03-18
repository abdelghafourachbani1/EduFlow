<?php

namespace App\Services;

use App\Repositories\Interfaces\CourseRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CourseService {
    protected $courseRepo;

    public function __construct(CourseRepositoryInterface $courseRepo) {
        $this->courseRepo = $courseRepo;
    }

    public function createCourse($data) {
        if(Auth::user()->role !== 'teacher') {
            abort(403,'only teachers can create courses');
        }
        $data['teacher_id'] = Auth::id();
        return $this->courseRepo->create($data);
    }

    public function updateCourse($id , $data) {
        $course = $this->courseRepo->findByTd($id);
        if(Auth::id() !== $course->teacher_id) {
            abort(403,'you are not the teacher of this course');
        }
        return $this->courseRepo->update($id, $data);
    }

    public function deleteCourse($id) {
        $course = $this->courseRepo->findByTd($id);
        if (Auth::id() !== $course->teacher_id) {
            abort(403,'you are not the teacher of this course');
        }
        return $this->courseRepo->delete($id);
    }

    public function listCourse() {
        return $this->courseRepo->getAll();
    }

    public function getCourse($id) {
        return $this->courseRepo->findByTd($id);
    }
}