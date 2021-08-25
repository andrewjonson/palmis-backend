<?php
namespace App\Repositories\Eloquent;

use App\Models\ModuleModel;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\ModuleModelRepositoryInterface;

class ModuleModelRepository extends BaseRepository implements ModuleModelRepositoryInterface
{
    public function __construct(ModuleModel $model)
    {
        $this->model = $model;
    }

    public function updateOrCreateModuleModels($moduleId, $modelId)
    {
        $this->model->updateOrCreate(
            ['module_id' => $moduleId],
            ['model_id' => $modelId]
        );
    }
}