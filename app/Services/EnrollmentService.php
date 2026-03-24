<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;

class EnrollmentService
{
    public function enroll($courseId) {
        
        $exists = Enrollment::where('user_id', Auth::id())
            ->where('course_id', $courseId)
            ->exists();

        if($exists){
            abort(400, 'Already enrolled in this course');
        }

        return Enrollment::create([
            'user_id' => Auth::id(),
            'course_id' => $courseId,
            'payment_status' => 'pending'
        ]);
    }

    public function withdraw($courseId)
    {
        return Enrollment::where('user_id', Auth::id())
            ->where('course_id', $courseId)
            ->delete();
    }
}
