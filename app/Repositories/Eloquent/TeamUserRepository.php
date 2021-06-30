<?php
namespace App\Repositories\Eloquent;

use App\Models\TeamUser;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\TeamUserRepositoryInterface;

class TeamUserRepository extends BaseRepository implements TeamUserRepositoryInterface
{
    public function __construct(TeamUser $model)
    {
        $this->model = $model;
    }

    public function unAssignedUsers(array $userId, $teamId)
    {
        return $this->model->whereNotIn('user_id', $userId)->where('team_id', $teamId)->delete();
    }

    public function assignUsers($userId, $teamId)
    {
        $this->model->firstOrCreate([
            'team_id' => $teamId,
            'user_id' => $userId
        ]);
    }
}