<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Model
{

    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function group() {
        return $this->belongsTo(Group::class);
    }

    protected $fillable = [
        'user_id',
        'course_id',
        'payment_status'
    ];

}
