<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
        return [
            'name' => 'required|max:30',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'mobile' => 'numeric|digits:11|unique:users,mobile',
            'role_id'=> 'required',
            'password' => 'required|min:3|confirmed'
        ];
    }
}
