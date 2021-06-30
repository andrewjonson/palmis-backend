<?php

namespace App\Events;

class UserHasRegistered extends Event
{
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $setting)
    {
        $this->user = $user;
        $this->setting = $setting;
    }
}
