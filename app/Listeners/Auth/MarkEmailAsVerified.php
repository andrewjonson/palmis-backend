<?php

namespace App\Listeners\Auth;

use Carbon\Carbon;

class MarkEmailAsVerified
{
    /**
     * Handle the event.
     *
     * @param  Verified  $event
     * @return void
     */
    public function handle($event)
    {
        $event->user->update([
            'email_verified_at' => Carbon::now()
        ]);
    }
}
