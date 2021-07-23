<?php
namespace App\Repositories\Interfaces;

interface UserRoleRepositoryInterface
{
    public function unAssignRoles(array $roleId, $userId);
}