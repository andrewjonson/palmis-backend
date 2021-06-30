<?php
namespace App\Repositories\Interfaces;

interface InviteRepositoryInterface
{
    public function deleteByEmail($email);
}