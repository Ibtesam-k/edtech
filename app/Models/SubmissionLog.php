<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionLog extends Model
{
    use HasFactory;
    protected $fillable = ['assignment_id', 'api_response_id', 'status', 'response_data'];

}
