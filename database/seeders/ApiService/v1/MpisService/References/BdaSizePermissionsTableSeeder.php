<?php

namespace Database\Seeders\ApiService\v1\MpisService\References;

use Illuminate\Database\Seeder;
use App\Traits\RestfulPermissionSeederTrait;
use App\Repositories\Interfaces\ModelRepositoryInterface;
use App\Repositories\Interfaces\ModuleRepositoryInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\ModuleModelRepositoryInterface;
use App\Repositories\Interfaces\ModelPermissionRepositoryInterface;

class BdaSizePermissionsTableSeeder extends Seeder
{
    use RestfulPermissionSeederTrait;

    protected $permissions = [
        'bdasize-read',
        'bdasize-create',
        'bdasize-update',
        'bdasize-delete'
    ];

    public function __construct(
        PermissionRepositoryInterface $permissionRepository,
        ModuleModelRepositoryInterface $moduleModelRepository,
        ModelRepositoryInterface $modelRepository,
        ModelPermissionRepositoryInterface $modelPermissionRepository,
        ModuleRepositoryInterface $moduleRepository
    )
    {
        $this->permissionRepository = $permissionRepository;
        $this->moduleModelRepository = $moduleModelRepository;
        $this->modelRepository = $modelRepository;
        $this->modelPermissionRepository = $modelPermissionRepository;
        $this->moduleRepository = $moduleRepository;
        $this->modelName = 'BdaSize';
        $this->moduleName = 'mpis';
    }
}
