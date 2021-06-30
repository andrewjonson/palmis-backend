<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamUser extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id', 'team_id', 'assigned'];
}
