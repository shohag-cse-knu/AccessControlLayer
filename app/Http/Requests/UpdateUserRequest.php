<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $userId = $this->route('user')->id;

        return [
            'name' => ['required', 'max:30'],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($userId)],
            'username' => ['required', Rule::unique('users', 'username')->ignore($userId)],
            'mobile' => ['numeric','digits:11', Rule::unique('users', 'mobile')->ignore($userId)],
            'role_id'=> ['required'],
            'password' => ['nullable', 'min:3', 'confirmed']
        ];
    }
}
