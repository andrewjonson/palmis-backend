<?php

namespace Database\Seeders\ApiService\v1\MpfService\Transactions;

use Illuminate\Database\Seeder;
use App\Traits\RestfulPermissionSeederTrait;
use App\Repositories\Interfaces\ModelRepositoryInterface;
use App\Repositories\Interfaces\ModuleRepositoryInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\ModuleModelRepositoryInterface;
use App\Repositories\Interfaces\ModelPermissionRepositoryInterface;

class PersonnelDocumentPermissionsTableSeeder extends Seeder
{
    use RestfulPermissionSeederTrait;

    protected $permissions = [
        'personneldocument-read',
        'personneldocument-create',
        'personneldocument-update',
        'personneldocument-delete'
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
        $this->modelName = 'PersonnelDocument';
        $this->moduleName = 'mpf';
    }
}
