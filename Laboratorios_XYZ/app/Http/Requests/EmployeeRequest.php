<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
			'internal_id' => 'required',
			'first_name' => 'required|string',
			'last_name' => 'required|string',
			'email' => 'required|string',
			'has_room_911_access' => 'required|boolean',
			'department_id' => 'required',
        ];
    }
}
