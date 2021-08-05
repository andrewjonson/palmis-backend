<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PersonnelResource extends JsonResource
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
            'afpsn' => $this->afpsn,
            'pmcode' => $this->PMCode,
            'first_name' => $this->firstname,
            'middle_name' => $this->middlename,
            'middle_initials' => $this->middleinitials,
            'last_name' => $this->lastname,
            'birthday' => $this->birthday,
            'pergroupname' => $this->pergroupname,
            'rank_code' => $this->rankcode,
            'afposmoscode' => $this->afposmoscode,
            'sll_number' => $this->sllnumber,
            'duty_code' => $this->dutycode,
            'duty_mode_code' => $this->dutymodecode,
            'appendage' => $this->appendage,
            'reg_status' => $this->reg_status
        ];
    }
}
