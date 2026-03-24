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

    public function remove($courseId) {
        return Wishlist::where('user_id', Auth::id())
            ->where('course_id', $courseId)
            ->delete();
    }

    public function list() {
        return Auth::user()->wishlist;
    }
}