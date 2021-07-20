<?php

namespace App\Http\Requests\Users;

use Anik\Form\FormRequest;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class PinRequest extends FormRequest
{
    public function __construct(SettingRepositoryInterface $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

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
            'pin' => 'numeric|digits:'.$this->settingRepository->first()->pin_digits.'|required_if:pin,!=,null'
        ];
    }
}
