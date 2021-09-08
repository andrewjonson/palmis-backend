<?php

namespace App\Http\Requests\ApiRequest\v1\OrderPubRequest\Transactions;

use Anik\Form\FormRequest;

class DocumentSettingRequest extends FormRequest
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
            'logo' => 'mimes:jpeg,jpg,png|image',
            'header' => 'required',
            'acronym' => 'required',
            'signatories' => 'required',
            'signatories.*.pmcode' => 'required',
            'signatories.*.designation' => 'required',
        ];
    }
}
