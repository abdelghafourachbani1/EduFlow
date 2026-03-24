<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;

class WishlistService {

    public function add($courseId) {
        return Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'course_id' => $courseId,
        ]);
    }
}