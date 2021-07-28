<?php

namespace App\Traits;

trait RestfulPermissionSeederTrait
{
    public function __construct()
    {
        $this->permissionRepository;
        $this->moduleModelRepository;
        $this->modelRepository;
        $this->modelPermissionRepository;
        $this->moduleRepository;
        $this->modelName;
        $this->moduleName;
    }

    public function run()
    {
        $model = $this->modelRepository->firstOrCreate([
            'name' => $this->modelName
        ]);

        $module = $this->moduleRepository->getModuleByName($this->moduleName);

        $this->moduleModelRepository->firstOrCreate([
            'module_id' => $module->id,
            'model_id' => $model->id
        ]);

        foreach($this->permissions as $permission) {
            $permission = $this->permissionRepository->firstOrCreate([
                'name' => $permission
            ]);

            $this->modelPermissionRepository->firstOrCreate([
                'model_id' => $model->id,
                'permission_id' => $permission->id
            ]);
        }
    }
}
