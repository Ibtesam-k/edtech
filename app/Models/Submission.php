<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $casts = [
        'submitted_at' => 'datetime',
    ];
   
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'assignment_id',
         'student_id',
         'submitted_at',
         'file_path',
     ];

     /**
     * A submission belongs to a student (User)
     */
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    /**
     * A submission belongs to an assignment
     */
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }
}
