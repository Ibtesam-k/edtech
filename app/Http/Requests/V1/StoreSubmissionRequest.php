<?php

namespace App\Http\Requests\V1;

use App\Rules\IsStudent;
use Illuminate\Foundation\Http\FormRequest;

class StoreSubmissionRequest extends FormRequest
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
            'assignment_id' => 'required|exists:assignments,id', 
            'student_id' => ['required','exists:users,id', new IsStudent()],
            'file_path' => 'required|string',
        ];
    }

}
