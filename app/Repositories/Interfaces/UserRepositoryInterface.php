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

    public function getUsersById(array $userId);

    public function unAssignTeams(array $userId, $teamId);

    public function assignTeams(array $userId, $teamId);

    public function assignTeam($userId, $teamId);

    public function unAssignTeam($userId, $teamId);

    public function assignModules(array $moduleId, $userId);

    public function unAssignUser($userId);
}