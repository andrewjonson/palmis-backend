<?php

namespace App\Models;

use App\Models\Team;
use App\Models\TeamUser;
use App\Models\Personnel;
use Wildside\Userstamps\Userstamps;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use App\Traits\RolesPermissions\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Services\TwoFactorAuthentication\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordInterface;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject, CanResetPasswordInterface
{
    use Authenticatable; 
    use Authorizable; 
    use HasFactory; 
    use Notifiable; 
    use CanResetPassword; 
    use TwoFactorAuthenticatable;
    use SoftDeletes;
    use Userstamps;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'afpsn',
        'password',
        'auth_status',
        'blocked_at',
        'email_verified_at',
        'otp_code',
        'otp_expire_at',
        'screen_lock',
        'pin',
        'is_superadmin',
        'team_id',
        'modules',
        'auth_type',
        'created_by',
        'two_factor_secret',
        'two_factor_recovery_codes'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'afpsn', 'afpsn');
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
