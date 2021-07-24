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
$router->group(['prefix' => 'api'], function() use($router) {
    $router->post('/login', 'Auth\LoginController@login');
    $router->post('/register', 'Auth\RegisterController@register');
    $router->post('/resend-email-verification', 'Auth\VerificationController@resendEmailVerification');
    $router->post('/reload-captcha', 'Auth\CaptchaController@reloadCaptcha');
    $router->post('/forgot-password', 'Auth\ForgotPasswordController@sendResetLink');
    $router->post('/reset-password', 'Auth\ResetPasswordController@reset');
    $router->post('/setup-account', 'Auth\VerificationController@setupAccount');
    $router->post('/otp-challenge', 'Auth\OtpController@otpChallenge');
    $router->post('/resend-otp', 'Auth\OtpController@resendOtp');
    $router->post('/two-factor-challenge', 'Auth\TwoFactorController@store');
});
$router->get('/captcha[/{config}]', 'Auth\CaptchaController@getCaptcha');
$router->get('/reset-password/{token}/{email}', 'Auth\ResetPasswordController@showResetForm');
$router->get('/verify/{email}/{token}', 'Auth\VerificationController@verify');

//User Management
$router->group(['middleware' => ['jwt', 'verified'], 'prefix' => 'api'], function() use($router) {
    $router->get('/users/current-user', 'Users\UserController@currentUser');
});

$router->group(['middleware' => ['jwt', 'verified', 'screenlockEnabled'], 'prefix' => 'api'], function() use($router) {
    $router->post('/users/disable-screenlock', 'Users\ScreenlockController@disable');
});

$router->group(['middleware' => ['jwt', 'verified', 'screenLockDisabled'], 'prefix' => 'api'], function() use($router) {
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
    $router->get('/users/login-attempts', 'Users\UserController@showLoginAttempts');
    $router->put('/users/assign-superadmin/{userId}', 'Users\UserController@assignSuperAdmin');
    $router->get('/users/account-type/{userId}', 'Users\UserController@accountType');
});

$router->group(['middleware' => ['jwt', 'verified', 'screenLockDisabled', 'superadmin'], 'prefix' => 'api'], function() use($router) {
    //Teams
    $router->get('/teams/show-units', 'TeamModules\TeamController@showUnits');
    $router->get('/teams', 'TeamModules\TeamController@showTeams');
    $router->post('/teams', 'TeamModules\TeamController@create');
    $router->delete('/teams/{teamId}', 'TeamModules\TeamController@delete');
    $router->get('/teams/only-trashed', 'TeamModules\TeamController@onlyTrashed');
    $router->put('/teams/restore/{teamId}', 'TeamModules\TeamController@restore');
    $router->delete('/teams/force-delete/{teamId}', 'TeamModules\TeamController@forceDelete');
    $router->post('/teams/assign-users/{teamId}', 'TeamModules\TeamController@assignUsers');
    $router->get('/teams/users-with-team/{teamId}', 'TeamModules\TeamController@usersWithTeam');
    $router->get('/teams/users-without-team', 'TeamModules\TeamController@usersWithoutTeam');
    $router->post('/teams/assign-all/{userId}', 'TeamModules\TeamController@assignAll');
    $router->put('/teams/unassign-user/{userId}', 'TeamModules\TeamController@unAssignUser');

    //Modules
    $router->post('/modules', 'TeamModules\ModuleController@create');
    $router->put('/modules/{moduleId}', 'TeamModules\ModuleController@update');
    $router->get('/modules', 'TeamModules\ModuleController@showModules');

    //Roles and Permissions
    $router->get('/roles', 'RolePermissions\RoleController@showRoles');
    $router->post('/roles', 'RolePermissions\RoleController@create');
    $router->put('/roles/{roleId}', 'RolePermissions\RoleController@update');
    $router->delete('/roles/{roleId}', 'RolePermissions\RoleController@delete');
    $router->post('/roles/assign-permissions', 'RolePermissions\RoleController@assignPermissions');
    $router->get('/permissions', 'RolePermissions\PermissionController@showPermissions');
    $router->post('/permissions', 'RolePermissions\PermissionController@create');
    $router->put('/permissions/{permissionId}', 'RolePermissions\PermissionController@update');
    $router->delete('/permissions/{permissionId}', 'RolePermissions\PermissionController@delete');

    //Units
    $router->get('/units/unit-by-code', 'Units\UnitController@getUnitByUnitCode');
    $router->get('/units', 'Units\UnitController@searchUnit');

    //Announcements
    $router->get('/announcements', 'Dashboard\AnnouncementController@index');
    $router->post('/announcements', 'Dashboard\AnnouncementController@create');
    $router->put('/announcements/{announcementId}', 'Dashboard\AnnouncementController@update');
    $router->delete('/announcements/{announcementId}', 'Dashboard\AnnouncementController@delete');
    $router->get('/announcements/only-trashed', 'Dashboard\AnnouncementController@onlyTrashed');
    $router->put('/announcements/restore/{announcementId}', 'Dashboard\AnnouncementController@restore');
    $router->delete('/announcements/force-delete/{announcementId}', 'Dashboard\AnnouncementController@forceDelete');
});