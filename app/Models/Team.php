<?php

namespace App\Models;

use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use Userstamps;

    protected $fillable = ['name'];
}