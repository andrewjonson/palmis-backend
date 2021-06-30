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
            'id' => $this->id,
            'afpsn' => $this->afpsn,
            'last_name' => $this->personnel->lastname,
            'first_name' => $this->personnel->firstname,
            'middle_name' => $this->personnel->middlename,
            'mobile_number' => $this->mobile_number,
            'email' => $this->email,
            'role' => $this->is_superadmin ? 'SuperAdmin' : 'User',
            'team' => $this->teamUser ? $this->teamUser->name : null,
            'status' => $this->auth_status ? 'Online' : 'Offline',
            'email_verified_at' => $this->email_verified_at,
            'screen_lock' => $this->screen_lock,
            'otp_auth' => $this->otp_auth
        ];
    }
}
