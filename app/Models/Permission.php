<?php

namespace App\Models;

use App\Services\RolesPermissions\Models\Permission as Permissions;

class Permission extends Permissions
{
    protected $fillable = ['name','guard_name'];
}