<?php

namespace App\Models;

use App\Models\TeamUser;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use Userstamps;

    protected $fillable = ['name'];

    public function teamUsers()
    {
        return $this->hasMany(TeamUser::class)
                    ->join('users', 'users.id', '=', 'team_users.user_id');
    }
}