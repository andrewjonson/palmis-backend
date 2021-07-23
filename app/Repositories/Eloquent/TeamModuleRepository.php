<?php
namespace App\Repositories\Eloquent;

use App\Models\TeamModule;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\TeamModuleRepositoryInterface;

class TeamModuleRepository extends BaseRepository implements TeamModuleRepositoryInterface
{
    public function __construct(TeamModule $model)
    {
        $this->model = $model;
    }

    public function unAssignModules(array $moduleId, $teamId)
    {
        $this->model->whereNotIn('module_id', $moduleId)->where('team_id', $teamId)->orWhereIn('module_id', $moduleId)->delete();
    }

    public function assignModules($moduleId, $teamId)
    {
        $this->model->firstOrCreate([
            'team_id' => $teamId,
            'module_id' => $moduleId
        ]);
    }
}