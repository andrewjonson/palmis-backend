<?php

namespace App\Models;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class TeamUser extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['user_id', 'team_id'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
