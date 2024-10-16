<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssignmentRequest extends FormRequest
{
      /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Change this if you need authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $method = $this->method();
        if($method == 'PUT')
        {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'due_date' => 'required|date|date_format:Y-m-d H:i|after:today',
         
        ];
    }
        else 
        {
            return [
                'title' => 'sometimes|required|string|max:255',
                'description' => 'sometimes|nullable|string',
                'course_id' => 'sometimes|required|exists:courses,id', 
                'due_date' => 'sometimes|required|date|date_format:Y-m-d H:i|after:today',
             
            ];
        }
    }

    public function messages()
    {
        return [
            'due_date.after' => "The due date can't be in the past",
        ];
    }
}
