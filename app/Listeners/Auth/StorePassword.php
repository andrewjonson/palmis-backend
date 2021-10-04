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
        $oldPasswords = $this->oldPasswordRepository->getOldPasswordsByUserId($event->user->id);
        if ($event->user->password) {
            if (count($oldPasswords) >= 5) {
                $this->deleteLastOldPassword($event->user);
            }
    
            $this->oldPasswordRepository->updateOrCreate(
                [
                    'user_id' => $event->user->id
                ],
                [
                    'old_password' => $event->user->password,
                    'user_id' => $event->user->id
                ]
            );
        }
    }

    protected function deleteLastOldPassword($user)
    {
        $this->oldPasswordRepository->deleteLastOldPassword($user->id);
    }
}