<?php
namespace App\Repositories\Interfaces;

interface TeamUserRepositoryInterface
{
    public function unAssignUsers(array $userId, $teamId);

    public function unAssignUser($userId, $teamId);

    public function assignUsers($userId, $teamId);
}