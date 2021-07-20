<?php

namespace App\Models;

use App\Models\ModuleModel;
use App\Models\ModelPermission;
use Illuminate\Database\Eloquent\Model as Models;

class Model extends Models
{
    protected $fillable = ['name'];

    public function modelPermissions()
    {
        return $this->hasMany(ModelPermission::class)
                    ->join('permissions', 'permissions.id', '=', 'model_permissions.permission_id');
    }

    public function moduleModels()
    {
        return $this->hasMany(ModuleModel::class);
    }
}
