<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function courses() {
        return $this->belongsToMany(Course::class);
    }

}
