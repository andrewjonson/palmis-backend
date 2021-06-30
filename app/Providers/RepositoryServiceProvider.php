<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Eloquent\TeamRepository;
use App\Repositories\Eloquent\UnitRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\InviteRepository;
use App\Repositories\Eloquent\SettingRepository;
use App\Repositories\Eloquent\PersonnelRepository;
use App\Repositories\Eloquent\OldPasswordRepository;
use App\Repositories\Eloquent\LoginAttemptRepository;
use App\Repositories\Interfaces\TeamRepositoryInterface;
use App\Repositories\Interfaces\UnitRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\InviteRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\EloquentRepositoryInterface;
use App\Repositories\Interfaces\PersonnelRepositoryInterface;
use App\Repositories\Interfaces\OldPasswordRepositoryInterface;
use App\Repositories\Interfaces\LoginAttemptRepositoryInterface;

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
    }
}
