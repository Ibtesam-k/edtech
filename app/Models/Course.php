<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;


        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
       'title',
        'description',
        'teacher_id',
    ];
    
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
