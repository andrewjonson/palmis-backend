<?php

namespace App\Providers;

use App\Services\Captcha\Captcha;
use Illuminate\Validation\Factory;
use Illuminate\Support\ServiceProvider;

/**
 * Class CaptchaServiceProvider
 * @package Wtone\Captcha
 */
class CaptchaServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return null
     */
    public function boot()
    {
        /* @var Factory $validator */
        $validator = $this->app['validator'];

        // Validator extensions
        $validator->extend('captcha_api', function ($attribute, $value, $parameters) {
            return captcha_api_check($value, $parameters[0]);
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Merge configs
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/captcha.php',
            'captcha'
        );

        // Bind captcha
        $this->app->bind('captcha', function ($app) {
            return new Captcha(
                $app['Illuminate\Filesystem\Filesystem'],
                $app['Illuminate\Contracts\Config\Repository'],
                $app['Intervention\Image\ImageManager'],
                $app['Illuminate\Hashing\BcryptHasher'],
                $app['Illuminate\Support\Str']
            );
        });
    }
}