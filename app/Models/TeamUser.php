<?php

namespace App\Models;

use App\Models\Team;
use Illuminate\Database\Eloquent\Model;

class TeamUser extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id', 'team_id'];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
