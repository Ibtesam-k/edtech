<?php

namespace App\Http\Requests\V1;

use App\Rules\IsStudent;
use Illuminate\Foundation\Http\FormRequest;

class BulkStoreSubmissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
   
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'submissions' => 'required|array|max:5', // Limit to 5 submissions
            'submissions.*.assignment_id' => 'required|exists:assignments,id', 
            'submissions.*.student_id' => ['required','exists:users,id', new IsStudent()],
            'submissions.*.file_path' => 'required|string', // Add this to validate file path as a string

        ];
    }

}
