<?php

namespace App\Models;

use App\Models\ModuleModel;
use App\Models\ModelPermission;
use Illuminate\Database\Eloquent\Model as Models;

class Model extends Models
{
    protected $fillable = ['name'];

    public function hahaha()
    {
        return $this->hasMany(ModelPermission::class, 'model_id', 'id');
    }

    public function moduleModels()
    {
        return $this->hasMany(ModuleModel::class);
    }
}
