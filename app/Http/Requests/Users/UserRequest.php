<?php

namespace App\Http\Requests\Users;

use Anik\Form\FormRequest;

class UserRequest extends FormRequest
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
        if ($this->userId) {
            return [
                'email' => [
                    'required',
                    'email',
                    'unique:users,email,'.$this->userId
                ],
                'current_password' => 'required'
            ];
        }

        return [
            'serial_number' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'current_password' => 'required'
        ];
    }
}
