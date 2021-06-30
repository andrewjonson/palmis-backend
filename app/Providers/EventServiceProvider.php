<?php

namespace App\Providers;

use App\Events\Verified;
use App\Events\ResetPassword;
use App\Events\UserHasRegistered;
use App\Listeners\Auth\StorePassword;
use App\Listeners\Auth\MarkEmailAsVerified;
use App\Listeners\Auth\SendEmailVerificationNotification;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserHasRegistered::class => [
            SendEmailVerificationNotification::class,
            StorePassword::class
        ],
        Verified::class => [
            MarkEmailAsVerified::class
        ],
        ResetPassword::class => [
            StorePassword::class
        ]
    ];
}
