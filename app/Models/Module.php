<?php

namespace App\Models;

use App\Models\ModuleModel;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use Userstamps;

    protected $fillable = ['name', 'description'];

    public function models()
    {
        return $this->hasMany(ModuleModel::class)
                    ->join('models', 'models.id', '=', 'module_models.model_id');
    }
}
