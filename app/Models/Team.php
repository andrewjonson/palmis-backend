<?php

namespace App\Models;

use App\Models\TeamUser;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use Userstamps;
    use SoftDeletes;

    protected $fillable = ['name'];

    public function teamUsers()
    {
        return $this->hasMany(TeamUser::class)
                    ->join('users', 'users.id', '=', 'team_users.user_id');
    }
}