<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

//Authentication
$router->post('/login', 'Auth\LoginController@login');
$router->post('/register', 'Auth\RegisterController@register');
$router->get('/verify/{email}/{token}', 'Auth\VerificationController@verify');
$router->post('/resend-email-verification', 'Auth\VerificationController@resendEmailVerification');
$router->get('/captcha[/{config}]', 'Auth\CaptchaController@getCaptcha');
$router->get('/reload-captcha', 'Auth\CaptchaController@reloadCaptcha');
$router->post('/forgot-password', 'Auth\ForgotPasswordController@sendResetLink');
$router->get('/reset-password/{token}/{email}', 'Auth\ResetPasswordController@showResetForm');
$router->post('/reset-password', 'Auth\ResetPasswordController@reset');
$router->post('/setup-account', 'Auth\VerificationController@setupAccount');
$router->post('/otp-challenge', 'Auth\OtpController@otpChallenge');
$router->post('/resend-otp', 'Auth\OtpController@resendOtp');
$router->post('/two-factor-challenge', 'Auth\TwoFactorController@store');

//User Management
$router->group(['middleware' => ['jwt', 'verified']], function() use($router) {
    $router->get('/users/current-user', 'Users\UserController@currentUser');
});

$router->group(['middleware' => ['jwt', 'verified', 'screenlockEnabled']], function() use($router) {
    $router->post('/users/disable-screenlock', 'Users\ScreenlockController@disable');
});

$router->group(['middleware' => ['jwt', 'verified', 'screenLockDisabled']], function() use($router) {
    $router->get('/users', 'Users\UserController@index');
    $router->get('/users/show/{userId}', 'Users\UserController@show');
    $router->put('/users/update/{userId}', 'Users\UserController@update');
    $router->put('/users/enable-otp', 'Auth\OtpController@enableOtp');
    $router->put('/users/disable-otp', 'Auth\OtpController@disableOtp');
    $router->post('/users/two-factor-authentication', 'Users\TwoFactorAuthenticationController@store');
    $router->delete('/users/two-factor-authentication', 'Users\TwoFactorAuthenticationController@destroy');
    $router->get('/users/two-factor-qr-code', 'Users\TwoFactorQrCodeController@show');
    $router->get('/users/two-factor-recovery-codes', 'Users\RecoveryCodeController@index');
    $router->post('/users/two-factor-recovery-codes', 'Users\RecoveryCodeController@store');
    $router->post('/users/invite', 'Users\InviteController@invite');
    $router->get('/users/show-invites', 'Users\InviteController@showInvites');
    $router->post('/users/enable-screenlock', 'Users\ScreenlockController@enable');
    $router->put('/users/change-password', 'Users\UserController@changePassword');
    $router->delete('/users/{userId}', 'Users\UserController@softDelete');
    $router->get('/users/only-trashed', 'Users\UserController@onlyTrashed');
    $router->put('/users/restore/{userId}', 'Users\UserController@restore');
    $router->delete('/users/force-delete/{userId}', 'Users\UserController@forceDelete');
});