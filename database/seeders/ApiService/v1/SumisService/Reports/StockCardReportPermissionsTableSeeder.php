<?php

namespace Database\Seeders\ApiService\v1\SumisService\Reports;

use Illuminate\Database\Seeder;
use App\Traits\RestfulPermissionSeederTrait;
use App\Repositories\Interfaces\ModelRepositoryInterface;
use App\Repositories\Interfaces\ModuleRepositoryInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\ModuleModelRepositoryInterface;
use App\Repositories\Interfaces\ModelPermissionRepositoryInterface;

class StockCardReportPermissionsTableSeeder extends Seeder
{
    use RestfulPermissionSeederTrait;

    protected $permissions = [
        'stockcardreport-read',
        'stockcardreport-create',
        'stockcardreport-update',
        'stockcardreport-delete'
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
        $this->modelName = 'StockCardReport';
        $this->moduleName = 'sumis';
    }
}
