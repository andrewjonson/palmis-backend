<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamModule extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = ['module_id', 'team_id'];
}
