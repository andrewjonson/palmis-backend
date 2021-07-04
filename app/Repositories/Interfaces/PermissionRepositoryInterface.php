<?php
namespace App\Repositories\Interfaces;

interface PermissionRepositoryInterface
{
    public function getPermissionsById(array $id);
}