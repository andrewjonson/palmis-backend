<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class ModelPermission extends EloquentModel
{
    protected $fillable = ['model_id', 'permission_id'];
    public $timestamps = false;
    public $incrementing = false;

    public function modelPermissions()
    {
        return $this->hasMany(Model::class);
    }
}
