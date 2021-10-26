<?php

namespace App\Http\Resources;

use App\Http\Resources\TeamResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\ApiService\v1\MpisService\Transactions\Personnel;

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
        $personnelService = new Personnel;
        $personnel = $personnelService->searchPersonnelBySerial([
            'serial_number' => $this->serial_number
        ])->{'original'}['data'][0];

        return [
            'id' => hashid_encode($this->id),
            'serial_number' => $this->serial_number,
            'last_name' => $personnel['lastname'],
            'first_name' => $personnel['firstname'],
            'middle_name' => isset($personnel['middlename']) ? $personnel['middlename'] : null,
            'email' => $this->email,
            'is_superadmin' => $this->is_superadmin,
            'role' => count($this->roles) == 0 ? null : $this->roles->pluck('name')->first(),
            'team' => $this->team_id ? new TeamResource($this->team) : null,
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
