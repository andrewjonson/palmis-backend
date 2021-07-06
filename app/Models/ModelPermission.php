<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModelPermission extends Model
{
    protected $fillable = ['model_id', 'permission_id'];
    public $timestamps = false;
    public $incrementing = false;
}
