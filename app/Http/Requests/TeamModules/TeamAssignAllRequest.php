<?php

namespace App\Http\Requests\TeamModules;

use Anik\Form\FormRequest;

class TeamAssignAllRequest extends FormRequest
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
            'team_id' => 'required',
            'module_id' => 'required',
            'role_id' => 'required'
        ];
    }
}
