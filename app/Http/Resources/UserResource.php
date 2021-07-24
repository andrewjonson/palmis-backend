<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => hashid_encode($this->id),
            'afpsn' => $this->afpsn,
            'last_name' => $this->personnel->lastname,
            'first_name' => $this->personnel->firstname,
            'middle_name' => $this->personnel->middlename,
            'email' => $this->email,
            'is_superadmin' => $this->is_superadmin,
            'role' => count($this->roles) == 0 ? null : $this->roles->pluck('name')->first(),
            'team' => $this->team_id ? $this->team->name : null,
            'status' => $this->auth_status ? 'Online' : 'Offline',
            'email_verified_at' => $this->email_verified_at,
            'screen_lock' => $this->screen_lock,
            'otp_auth' => $this->otp_auth,
            'deleted_at' => $this->deleted_at,
            'auth_status' => $this->auth_status,
            'pin' => $this->pin,
            'two_factor_auth' => $this->two_factor_secret,
        ];
    }
}
