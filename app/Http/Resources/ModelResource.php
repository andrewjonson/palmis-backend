<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\DB;
use App\Http\Resources\PermissionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ModelResource extends JsonResource
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
            'permissions' => PermissionResource::collection(DB::table('model_permissions')->join('permissions', 'permissions.id', '=', 'model_permissions.permission_id')->where('model_id', $this->id)->get())
        ];
    }
}