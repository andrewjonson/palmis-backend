<?php

namespace App\Listeners\Auth;

use App\Notifications\EmailVerificationNotification;

class SendEmailVerificationNotification
{
    /**
     * Handle the event.
     *
     * @param  UserHasRegistered  $event
     * @return void
     */
    public function handle($event)
    {
        $event->user->notify(new EmailVerificationNotification($event->setting));
    }
}
