<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function interests() {
        return $this->belongsToMany(Interest::class);
    }

    public function wishedBy() {
        return $this->belongsToMany(User::class, 'wishlists');
    }

    public function enrollments() {
        return $this->hasMany(Enrollment::class);
    }

}
