<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
            'description' => 'required',
            'active' => 'required',
            'chk' => 'required|array|min:1',
            'chk.*' => 'integer|exists:menus,id', // Each item in 'chk' must be a valid integer and exist in a table (e.g., permissions table)
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'chk.required' => 'At least one checkbox must be selected.',
            'chk.array' => 'The chk field must be an array.',
            'chk.*.integer' => 'Each selected checkbox must be a valid integer.',
            'chk.*.exists' => 'One or more selected values are invalid.',
        ];
    }
}
