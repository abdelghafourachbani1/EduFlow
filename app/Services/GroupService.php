<?php

namespace App\Services;

use App\Models\Group;
use App\Models\Enrollment;

class GroupService
{
    public function assignStudentToGroup($courseId, $enrollmentId) {
        $group = Group::where('course_id', $courseId)
            ->orderBy('group_number', 'desc')
            ->first();

        if(!$group){
            $group = Group::create([
                'course_id' => $courseId,
                'group_number' => 1
            ]);
        }

        $count = $group->enrollments()->count();

        if($count >= 25){
            $group = Group::create([
                'course_id' => $courseId,
                'group_number' => $group->group_number + 1
            ]);
        }

        $enrollment = Enrollment::findOrFail($enrollmentId);
        $enrollment->group_id = $group->id;
        $enrollment->save();

        return $group;
    }
}
