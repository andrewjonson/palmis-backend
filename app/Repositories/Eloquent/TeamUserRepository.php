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

    public function unAssignUsers(array $userId, $teamId)
    {
        $this->model->whereNotIn('user_id', $userId)->where('team_id', $teamId)->orWhereIn('user_id', $userId)->delete();
    }

    public function unAssignUser($userId, $teamId)
    {
        $this->model->where('user_id', '!=', $userId)->where('team_id', $teamId)->orWhere('user_id', $userId)->delete();
    }

    public function assignUsers($userId, $teamId)
    {
        $this->model->firstOrCreate([
            'team_id' => $teamId,
            'user_id' => $userId
        ]);
    }
}