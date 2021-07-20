<?php
namespace App\Traits\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

trait CaptchaTrait
{
    public function captchaResponse($message, $errorCode) 
    {
        return response()->json([
            'type' => 1,
            'message' => $message,
            'captcha' => json_decode($this->captcha())
        ], $errorCode);
    }

    public function captcha() 
    {
        $req = Request::create(Config::get('app.url').'/captcha/flat', 'GET');
        $res = app()->handle($req);
        return $res->getContent();
    }

    public function captchaValidator($user) 
    {
        $rules = ['captcha' => 'required|captcha_api:'.request('key').',flat'];
        return Validator::make(request()->all(), $rules);
    }
}