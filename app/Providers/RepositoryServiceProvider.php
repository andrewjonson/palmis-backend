<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\RoleRepository;
use App\Repositories\Eloquent\TeamRepository;
use App\Repositories\Eloquent\UnitRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\ModelRepository;
use App\Repositories\Eloquent\InviteRepository;
use App\Repositories\Eloquent\ModuleRepository;
use App\Repositories\Eloquent\SettingRepository;
use App\Repositories\Eloquent\UserRoleRepository;
use App\Repositories\Eloquent\PersonnelRepository;
use App\Repositories\Eloquent\PermissionRepository;
use App\Repositories\Eloquent\ModuleModelRepository;
use App\Repositories\Eloquent\OldPasswordRepository;
use App\Repositories\Eloquent\AnnouncementRepository;
use App\Repositories\Eloquent\LoginAttemptRepository;
use App\Repositories\Eloquent\RolePermissionRepository;
use App\Repositories\Eloquent\ModelPermissionRepository;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\TeamRepositoryInterface;
use App\Repositories\Interfaces\UnitRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\ModelRepositoryInterface;
use App\Repositories\Interfaces\InviteRepositoryInterface;
use App\Repositories\Interfaces\ModuleRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\EloquentRepositoryInterface;
use App\Repositories\Interfaces\UserRoleRepositoryInterface;
use App\Repositories\Interfaces\PersonnelRepositoryInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\ModuleModelRepositoryInterface;
use App\Repositories\Interfaces\OldPasswordRepositoryInterface;
use App\Repositories\Interfaces\AnnouncementRepositoryInterface;
use App\Repositories\Interfaces\LoginAttemptRepositoryInterface;
use App\Repositories\Interfaces\RolePermissionRepositoryInterface;
use App\Repositories\Interfaces\ModelPermissionRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(PersonnelRepositoryInterface::class, PersonnelRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, SettingRepository::class);
        $this->app->bind(LoginAttemptRepositoryInterface::class, LoginAttemptRepository::class);
        $this->app->bind(OldPasswordRepositoryInterface::class, OldPasswordRepository::class);
        $this->app->bind(InviteRepositoryInterface::class, InviteRepository::class);
        $this->app->bind(TeamRepositoryInterface::class, TeamRepository::class);
        $this->app->bind(UnitRepositoryInterface::class, UnitRepository::class);
        $this->app->bind(ModuleRepositoryInterface::class, ModuleRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(PermissionRepositoryInterface::class, PermissionRepository::class);
        $this->app->bind(ModelRepositoryInterface::class, ModelRepository::class);
        $this->app->bind(ModelPermissionRepositoryInterface::class, ModelPermissionRepository::class);
        $this->app->bind(ModuleModelRepositoryInterface::class, ModuleModelRepository::class);
        $this->app->bind(AnnouncementRepositoryInterface::class, AnnouncementRepository::class);
        $this->app->bind(UserRoleRepositoryInterface::class, UserRoleRepository::class);
        $this->app->bind(RolePermissionRepositoryInterface::class, RolePermissionRepository::class);
    }
}
