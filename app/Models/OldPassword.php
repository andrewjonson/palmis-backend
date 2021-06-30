<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OldPassword extends Model
{
    protected $fillable = ['old_password', 'user_id'];
}
