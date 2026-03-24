<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class RecommendationService {

    public function getRecommendedCourses() {
        $user = Auth::user();
        $interestIds = $user->interests->pluck('id');

        return Course::whereHas('interests' , function($query) use ($interestIds) {
            $query->whereIn('intrests.id' , $interestIds);
        })->get(); 
    }
    
}