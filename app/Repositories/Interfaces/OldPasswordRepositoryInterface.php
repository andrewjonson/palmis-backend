<?php
namespace App\Repositories\Interfaces;

interface OldPasswordRepositoryInterface
{
    public function getOldPasswordsByUserId($user_id);

    public function deleteLastOldPassword($user_id);
}