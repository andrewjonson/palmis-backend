<?php
namespace App\Repositories\Interfaces;

interface TeamUserRepositoryInterface
{
    public function getUsersById(array $userId);

    public function unAssignUsers(array $userId, $teamId);

    public function assignUsers($userId, $teamId);
}