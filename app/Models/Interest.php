<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Interest extends Model
{

    use HasFactory;

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function courses() {
        return $this->belongsToMany(Course::class);
    }

}
