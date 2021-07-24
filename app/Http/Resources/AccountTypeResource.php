<?php

namespace App\Http\Resources;

use App\Http\Resources\RoleResource;
use App\Http\Resources\ModuleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountTypeResource extends JsonResource
{
    protected $moduleRepository;

    public function __construct($resource, $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
        $this->resource = $resource;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->is_superadmin) {
            return [
                'account_type' => 'Superadmin'
            ];
        }

        return [
            'account_type' => 'Normal',
            'team' => $this->team->name,
            'modules' => ModuleResource::collection($this->moduleRepository->getModulesById(unserialize($this->modules))),
            'roles' => RoleResource::collection($this->roles)
        ];
    }
}
