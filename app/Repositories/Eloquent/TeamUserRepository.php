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

    public function getUsersById(array $userId)
    {
        return $this->model->whereIn('user_id', $userId)->pluck('user_id');
    }

    public function unAssignUsers(array $userId, $teamId)
    {
        $this->model->whereNotIn('user_id', $userId)->updateOrCreate([
            'user_id' => $userId,
            'team_id' => $teamId,
            'assigned' => false
        ]);
    }

    public function assignUsers($userId, $teamId)
    {
        $this->model->where('team_id', $teamId)->where('user_id', $userId)->update([
            'user_id' => $userId,
            'team_id' => $teamId,
            'assigned' => true
        ]);
    }
}