<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'project_label',
        'frontend_domain',
        'max_login_attempts',
        'captcha_login_attempts',
        'block_duration',
        'otp_digits',
        'otp_expiration',
        'mail_expiration',
        'pin_digits',
        'logo'
    ];

    public $timestamps = false;
}
