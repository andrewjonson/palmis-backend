<?php
namespace App\Repositories\Interfaces;

interface TeamUserRepositoryInterface
{
    public function unAssignedUsers(array $userId, $teamId);

    public function assignUsers($userId, $teamId);
}