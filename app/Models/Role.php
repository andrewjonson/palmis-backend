<?php

namespace App\Models;

use App\Services\RolesPermissions\Models\Role as Roles;

class Role extends Roles
{
    protected $fillable = ['name','guard_name'];
}
