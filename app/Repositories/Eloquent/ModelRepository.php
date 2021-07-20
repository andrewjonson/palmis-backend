<?php
namespace App\Repositories\Eloquent;

use App\Models\Model;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\ModelRepositoryInterface;

class ModelRepository extends BaseRepository implements ModelRepositoryInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getModelsWithoutModule()
    {
        return $this->model->doesntHave('moduleModels')->get();
    }
}