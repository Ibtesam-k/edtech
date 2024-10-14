<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /** course teacher */
    public function teacher() {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    /** students enrolled in the course */
    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'student_id');
    }

    /** course assignments  */
    public function assignments() {
        return $this->hasMany(Assignment::class);
    }
    
}
