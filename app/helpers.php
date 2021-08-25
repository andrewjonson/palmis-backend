<?php

use Intervention\Image\ImageManager;

if (!function_exists('captcha')) {
    /**
     * @param string $config
     * @return array|ImageManager|mixed
     * @throws Exception
     */
    function captcha(string $config = 'default')
    {
        return app('captcha')->create($config);
    }
}

if (!function_exists('captcha_src')) {
    /**
     * @param string $config
     * @return string
     */
    function captcha_src(string $config = 'default'): string
    {
        return app('captcha')->src($config);
    }
}

if (!function_exists('captcha_img')) {

    /**
     * @param string $config
     * @return string
     */
    function captcha_img(string $config = 'default'): string
    {
        return app('captcha')->img($config);
    }
}

if (!function_exists('captcha_check')) {
    /**
     * @param string $value
     * @return bool
     */
    function captcha_check(string $value): bool
    {
        return app('captcha')->check($value);
    }
}

if (!function_exists('captcha_api_check')) {
    /**
     * @param string $value
     * @param string $key
     * @param string $config
     * @return bool
     */
    function captcha_api_check(string $value, string $key, string $config = 'default'): bool
    {
        return app('captcha')->check_api($value, $key, $config);
    }
}

if (! function_exists('getModelForGuard')) {
    /**
     * @param string $guard
     *
     * @return string|null
     */
    function getModelForGuard(string $guard)
    {
        return collect(config('auth.guards'))
            ->map(function ($guard) {
                if (! isset($guard['provider'])) {
                    return;
                }

                return config("auth.providers.{$guard['provider']}.model");
            })->get($guard);
    }
}

if ( ! function_exists('config_path')) {
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
    }
}

if (!function_exists('public_path')) {
    /**
     * Get the path to the public folder.
     *
     * @param  string $path
     * @return string
     */
     function public_path($path = '')
     {
         return env('PUBLIC_PATH', base_path('public')) . ($path ? '/' . $path : $path);
     }
 }
