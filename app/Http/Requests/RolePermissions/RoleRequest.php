<?php

namespace App\Http\Requests\RolePermissions;

use Anik\Form\FormRequest;

class RoleRequest extends FormRequest
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
        if ($this->roleId) {
            return [
                'name' => 'required|alpha|unique:roles,name,'.$this->roleId
            ];
        }

        return [
            'name' => 'required|alpha|unique:roles'
        ];
    }
}
