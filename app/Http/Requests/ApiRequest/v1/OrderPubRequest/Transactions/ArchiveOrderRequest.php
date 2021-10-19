<?php

namespace App\Http\Requests\ApiRequest\v1\OrderPubRequest\Transactions;

use Anik\Form\FormRequest;

class ArchiveOrderRequest extends FormRequest
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
            'attachment' => 'required|mimes:pdf',
            'order_number' => 'required',
            'type_id' => 'required',
            'date' => 'required|date',
            'pmcode' => 'required'
        ];
    }
}
