<?php

namespace App\Http\Requests\ApiService\v1\MpfService\Transactions;

use Anik\Form\FormRequest;

class UploadTabRequest extends FormRequest
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
            'attachments.*' => 'required|mimes:jpg,jpeg,png,pdf',
            'pmcode' => 'required',
            'effectivityDate' => 'required|date'
        ];
    }
}