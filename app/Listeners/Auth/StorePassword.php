<?php

namespace App\Listeners\Auth;

use App\Events\UserHasRegistered;
use App\Repositories\Interfaces\OldPasswordRepositoryInterface;

class StorePassword
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(OldPasswordRepositoryInterface $oldPasswordRepository)
    {
        $this->oldPasswordRepository = $oldPasswordRepository;
    }

    /**
     * Handle the event.
     *
     * @param  UserHasRegistered  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->user->password) {
            if ($this->countOldPasswords($event->user) >= 5) {
                $this->deleteLastOldPassword($event->user);
            }
    
            $this->oldPasswordRepository->updateOrCreate([
                'old_password' => $event->user->password,
                'user_id' => $event->user->id
            ]);
        }
    }

    protected function countOldPasswords($user)
    {
        $oldPasswords = $this->oldPasswordRepository->getOldPasswordsByUserId($user->id);
        return count($oldPasswords);
    }

    protected function deleteLastOldPassword($user)
    {
        $this->oldPasswordRepository->deleteLastOldPassword($user->id);
    }
}