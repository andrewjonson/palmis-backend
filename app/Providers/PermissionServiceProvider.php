<?php

namespace App\Providers;

use Illuminate\Routing\Route;
use Illuminate\Support\Collection;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use App\Services\RolesPermissions\Interfaces\Role as RoleContract;
use App\Services\RolesPermissions\PermissionRegistrar;
use App\Services\RolesPermissions\Interfaces\Permission as PermissionContract;

class PermissionServiceProvider extends ServiceProvider
{
    public function boot(PermissionRegistrar $permissionLoader)
    {
        $this->offerPublishing();

        $this->registerMacroHelpers();

        $this->registerModelBindings();

        $permissionLoader->clearClassPermissions();
        $permissionLoader->registerPermissions();

        $this->app->singleton(PermissionRegistrar::class, function ($app) use ($permissionLoader) {
            return $permissionLoader;
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/permission.php',
            'permission'
        );
    }

    protected function offerPublishing()
    {
        if (! function_exists('config_path')) {
            // function not available and 'publish' not relevant in Lumen
            return;
        }

        $this->publishes([
            __DIR__.'/../../config/permission.php' => config_path('permission.php'),
        ], 'config');
    }

    protected function registerModelBindings()
    {
        $config = $this->app->config['permission.models'];

        if (! $config) {
            return;
        }

        $this->app->bind(PermissionContract::class, $config['permission']);
        $this->app->bind(RoleContract::class, $config['role']);
    }

    protected function registerMacroHelpers()
    {
        if (! method_exists(Route::class, 'macro')) { // Lumen
            return;
        }

        Route::macro('role', function ($roles = []) {
            if (! is_array($roles)) {
                $roles = [$roles];
            }

            $roles = implode('|', $roles);

            $this->middleware("role:$roles");

            return $this;
        });

        Route::macro('permission', function ($permissions = []) {
            if (! is_array($permissions)) {
                $permissions = [$permissions];
            }

            $permissions = implode('|', $permissions);

            $this->middleware("permission:$permissions");

            return $this;
        });
    }
}
