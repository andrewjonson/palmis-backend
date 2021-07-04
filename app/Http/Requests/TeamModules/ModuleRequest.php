<?php

namespace App\Http\Requests\TeamModules;

use Anik\Form\FormRequest;

class ModuleRequest extends FormRequest
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
        if ($this->id) {
            return [
                'name' => 'required|alpha|string|unique:modules,name,'.$this->id
            ];
        }

        return [
            'name' => 'required|alpha|string|unique:modules'
        ];
    }
}
