<?php
namespace App\Repositories\Interfaces;

interface LoginAttemptRepositoryInterface
{
    public function getLoginAttempts($user);

    public function deleteLoginAttempts($user);
}