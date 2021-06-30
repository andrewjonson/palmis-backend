<?php
namespace App\Repositories\Eloquent;

use App\Models\Unit;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\UnitRepositoryInterface;

class UnitRepository extends BaseRepository implements UnitRepositoryInterface
{
    public function __construct(Unit $model)
    {
        $this->model = $model;
    }

    public function getUnitByUnitCode($unitCode)
    {
        return $this->model->where('UnitCode', $unitCode)->first();
    }
}