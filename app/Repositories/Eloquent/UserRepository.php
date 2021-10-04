<?php
namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getUserByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function enableOtp(array $userId)
    {
        $this->model
            ->whereIn('id', $userId)
            ->update([
                'otp_auth' => true
            ]);
    }

    public function disableOtp(array $userId)
    {
        $this->model->whereIn('id', $userId)->update([
            'otp_auth' => false
        ]);
    }

    public function otpEnabled($userId)
    {
        return $this->model->where('id', $userId)->where('otp_auth', true)->first();
    }

    public function getUsersWithTeam($teamId, $keyword, $rowsPerPage)
    {
        return $this->columns($keyword)->where('team_id', $teamId)->paginate($rowsPerPage);
    }

    public function getUsersWithoutTeam()
    {
        return $this->model->whereNull('team_id')->get();
    }

    public function getUsersById(array $userId)
    {
        return $this->model->whereIn('id', $userId)->pluck('id')->toArray();
    }

    public function unAssignTeams(array $userId, $teamId)
    {
        $this->model
            ->whereNotIn('id', $userId)
            ->where('team_id', $teamId)
            ->orWhereIn('id', $userId)
            ->update([
                'team_id' => null
            ]);
    }

    public function unAssignTeam($userId, $teamId)
    {
        $this->model
            ->where('id', '!=', $userId)
            ->where('team_id', $teamId)
            ->orWhere('id', '!=', $userId)
            ->update([
                'team_id' => null
            ]);
    }

    public function assignTeams(array $userId, $teamId)
    {
        $this->model->whereIn('id', $userId)->update([
            'team_id' => $teamId
        ]);
    }

    public function assignTeam($userId, $teamId)
    {
        $this->model->where('id', $userId)->update([
            'team_id' => $teamId
        ]);
    }

    public function unAssignModules($moduleId, $teamId)
    {
        $this->model
            ->whereNotIn('modules', $moduleId)
            ->where('team_id', $teamId)
            ->orWhereIn('modules', $moduleId)
            ->update([
                'modules' => null
            ]);
    }

    public function assignModules($moduleId, $userId)
    {
        $this->model->where('id', $userId)->update([
            'modules' => $moduleId
        ]);
    }

    public function unAssignUser($userId)
    {
        $this->model->where('id', $userId)->update([
            'team_id' => null
        ]);
    }
}