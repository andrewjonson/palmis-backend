<?php

namespace App\Http\Resources;

use App\Http\Resources\ModelResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ModuleModelPermissionResource extends JsonResource
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
            'description' => $this->description,
            'model_permissions' => count($this->models) > 0 ? ModelResource::collection($this->models) : null
        ];
    }
}
