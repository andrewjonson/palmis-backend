<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\Providers\TwoFactorAuthenticationProvider;
use App\Services\TwoFactorAuthentication\Contracts\TwoFactorAuthenticationProvider as TwoFactorAuthenticationProviderContract;

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE', 'UTC'));

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

$app->withFacades(true, [
    'Illuminate\Support\Facades\Notification' => 'Notification',
]);

$app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    TwoFactorAuthenticationProviderContract::class,
    TwoFactorAuthenticationProvider::class
);

/*
|--------------------------------------------------------------------------
| Register Config Files
|--------------------------------------------------------------------------
|
| Now we will register the "app" configuration file. If the file exists in
| your configuration directory it will be loaded; otherwise, we'll load
| the default version. You may register other files below as needed.
|
*/

$app->configure('auth');
$app->configure('app');
$app->configure('database');
$app->configure('mail');
$app->configure('queue');
$app->configure('captcha');
$app->configure('permission');
$app->configure('services');
$app->configure('hashid');

require_once __DIR__. './constant.php';

$app->alias('mailer', \Illuminate\Contracts\Mail\Mailer::class);
$app->alias('mail.manager', Illuminate\Mail\MailManager::class);
$app->alias('mail.manager', Illuminate\Contracts\Mail\Factory::class);
$app->alias('cache', \Illuminate\Cache\CacheManager::class);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

$app->middleware([
    App\Http\Middleware\CorsMiddleware::class
]);

$app->routeMiddleware([
    'auth' => App\Http\Middleware\Authenticate::class,
    'jwt' => App\Http\Middleware\JwtMiddleware::class,
    'verified' => App\Http\Middleware\EmailVerificationMiddleware::class,
    'superadmin' => App\Http\Middleware\SuperAdminMiddleware::class,
    'screenlockEnabled' => App\Http\Middleware\ScreenLockEnabledMiddleware::class,
    'screenLockDisabled' => App\Http\Middleware\ScreenLockDisabledMiddleware::class,
    'permission' => App\Http\Middleware\PermissionMiddleware::class,
    'role' => App\Http\Middleware\RoleMiddleware::class,
    'modular' => App\Http\Middleware\ModularMiddleware::class,
]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
$app->register(App\Providers\RepositoryServiceProvider::class);
$app->register(Flipbox\LumenGenerator\LumenGeneratorServiceProvider::class);
$app->register(Tymon\JWTAuth\Providers\LumenServiceProvider::class);
$app->register(Anik\Form\FormRequestServiceProvider::class);
$app->register(Illuminate\Notifications\NotificationServiceProvider::class);
$app->register(\Illuminate\Mail\MailServiceProvider::class);
$app->register(App\Providers\EventServiceProvider::class);
$app->register(App\Providers\CaptchaServiceProvider::class);
$app->register(Illuminate\Auth\Passwords\PasswordResetServiceProvider::class);
$app->register(App\Providers\PermissionServiceProvider::class);
$app->register(ElfSundae\Laravel\Hashid\HashidServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/pais-template.php';
    require __DIR__.'/../routes/mpf.php';
    require __DIR__.'/../routes/mpis.php';
    require __DIR__.'/../routes/orderpub.php';
});

return $app;
