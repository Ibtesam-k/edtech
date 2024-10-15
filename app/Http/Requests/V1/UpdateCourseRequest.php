<?php

namespace App\Http\Requests\V1;

use App\Rules\IsTeacher;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $method = $this->method();
        if($method == 'PUT')
        {
            return [
                'title' => 'required|string|max:255',
                'description' => 'required|string|max:1000',  
                'teacher_id' => ['required','exists:users,id', new IsTeacher()], 

            ];
        }
        else
        {
            return [
                'title' => 'sometimes|required|string|max:255',
                'description' => 'sometimes|required|string|max:1000',  
                'teacher_id' => ['sometimes','required','exists:users,id', new IsTeacher()], 

            ];
        }
      
    }
}
