<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleModel extends Model
{
    protected $fillable = ['module_id', 'model_id'];
    public $timestamps = false;
    public $incrementing = false;
}
