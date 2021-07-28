<?php
namespace App\Repositories\Eloquent;

use App\Models\Module;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\ModuleRepositoryInterface;

class ModuleRepository extends BaseRepository implements ModuleRepositoryInterface
{
    public function __construct(Module $model)
    {
        $this->model = $model;
    }

    public function getModulesById(array $moduleId)
    {
        return $this->model->whereIn('id', $moduleId)->get();
    }

    public function getModulesWithModel()
    {
        return $this->model->has('models')->get();
    }

    public function getModuleByName($moduleName)
    {
        return $this->model->where('name', $moduleName)->first();
    }
}