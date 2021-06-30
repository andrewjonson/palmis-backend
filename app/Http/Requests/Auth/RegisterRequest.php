<?php

namespace App\Http\Requests\Auth;

use Anik\Form\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    protected function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function rules(): array
    {
        return [
            'afpsn' => 'required|unique:users',
            'birthday' => 'required|date|date_format:Y-m-d',
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(5)
                    ->letters()
                    ->numbers()
                    ->mixedCase()
            ],
            'email' => 'required|email|unique:users'
        ];
    }
}
