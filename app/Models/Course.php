<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{

    use HasFactory;

    public function interests() {
        return $this->belongsToMany(Interest::class);
    }

    public function wishedBy() {
        return $this->belongsToMany(User::class, 'wishlists');
    }

    public function enrollments() {
        return $this->hasMany(Enrollment::class);
    }

    public function groups() {
        return $this->hasMany(Group::class);
    }

    protected $fillable = [
        'title',
        'description',
        'price',
        'teacher_id'
    ];

}
