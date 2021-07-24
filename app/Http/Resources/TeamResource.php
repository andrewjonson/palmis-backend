<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            'name' => $this->name,
            'description' => DB::connection('pamis')->table('tr_unit')->where('UnitCode', $this->name)->first()->UnitDesc,
            'total_users' => count($this->users)
        ];
    }
}
