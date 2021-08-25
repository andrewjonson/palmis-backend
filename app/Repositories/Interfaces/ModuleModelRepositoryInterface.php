<?php
namespace App\Repositories\Interfaces;

interface ModuleModelRepositoryInterface
{
    public function updateOrCreateModuleModels($moduleId, $modelId);
}