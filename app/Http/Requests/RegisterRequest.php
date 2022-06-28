<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|integer|exists:roles,id',
            'country_id' => 'nullable|integer|exists:countries,id',
            'badge' => 'nullable|string|max:255',
            'avatar' => 'nullable|string|max:255',
            'contact' => 'nullable|string|max:255',
            'gender' => ['required', Rule::in('M', 'F')],
            'birthday' => 'nullabe|date',
        ];
    }
}
