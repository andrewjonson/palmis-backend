<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    protected $connection = 'pamis';
    protected $table = 'tr_master';
}
