<?php

namespace App\Http\Requests\Auth;

use Anik\Form\FormRequest;
use App\Services\TwoFactorAuthentication\Contracts\TwoFactorAuthenticationProvider;

class TwoFactorAuthRequest extends FormRequest
{
    /**
     * Indicates if the user wished to be remembered after login.
     *
     * @var bool
     */
    protected $remember;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'code' => 'nullable|string',
            'recovery_code' => 'nullable|string',
        ];
    }

    /**
     * Determine if the request has a valid two factor code.
     *
     * @return bool
     */
    public function hasValidCode($user)
    {
        return $this->code && app(TwoFactorAuthenticationProvider::class)->verify(
            decrypt($user->two_factor_secret), $this->code
        );
    }

    /**
     * Get the valid recovery code if one exists on the request.
     *
     * @return string|null
     */
    public function validRecoveryCode($user)
    {
        if (! $this->recovery_code) {
            return;
        }

        return collect($user->recoveryCodes())->first(function ($code) {
            return hash_equals($this->recovery_code, $code) ? $code : null;
        });
    }
}
