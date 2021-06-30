<?php

namespace App\Http\Requests\Auth;

use Anik\Form\FormRequest;
use Illuminate\Validation\Rules\Password;

class ResetPasswordRequest extends FormRequest
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
            'email' => [
                'required',
                'email'
            ],
            'password' => [
                'required',
                'string',
                'confirmed',
                Password::min(5)
                    ->letters()
                    ->numbers()
                    ->mixedCase()
            ],
            'token' => 'required'
        ];
    }
}
