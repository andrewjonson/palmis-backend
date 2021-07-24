<?php

namespace App\Models;

use App\Models\User;
use Wildside\Userstamps\Userstamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use Userstamps;
    use SoftDeletes;

    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}