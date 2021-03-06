<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Traits\ResponseTrait;
use App\Services\Captcha\Captcha;
use App\Traits\Auth\CaptchaTrait;
use App\Http\Controllers\Controller;

class CaptchaController extends Controller
{
    use CaptchaTrait, ResponseTrait;

    public function getCaptcha(Captcha $captcha, string $config = 'default')
    {
        try {
            return $captcha->create($config, true);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }

    public function reloadCaptcha()
    {
        try {
            return $this->captchaResponse(trans('auth.reload_captcha'), DATA_OK);
        } catch(Exception $e) {
            return $this->failedResponse($e->getMessage(), SERVER_ERROR);
        }
    }
}