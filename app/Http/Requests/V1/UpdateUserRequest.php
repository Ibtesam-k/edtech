<?php

namespace App\Http\Requests\V1;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $user = $this->route('user');
        if($method == 'PUT')
        {
            return [
                //
                'name' => 'required|string|max:255',
                'email' => ['required',Rule::unique('users')->ignore($user)],
                'password' => 'required|min:8',
                'role' => 'required|in:student,teacher',
            ];
        }
        else
        {
            return [
                //
                'name' => 'sometimes|required|string|max:255',
                'email' => [ 'sometimes','required',Rule::unique('users')->ignore($user)],
                'password' => 'sometimes|required|min:8',
                'role' => 'sometimes|required|in:student,teacher',
            ];
        }
      
    }
}
