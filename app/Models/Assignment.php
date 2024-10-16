<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    protected $casts = [
        'due_date' => 'datetime',
    ];

          /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
         'description',
         'course_id',
         'due_date',
     ];
     
    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function submissions() {
        return $this->hasMany(Submission::class);
    }
}
