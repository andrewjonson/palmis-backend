<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function getUserByEmail($email);

    public function enableOtp(array $userId);

    public function disableOtp(array $userId);

    public function otpEnabled($userId);

    public function getUsersWithTeam($teamId);

    public function getUsersWithoutTeam();

    public function unAssignedUsers(array $userId);
}