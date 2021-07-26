<?php
namespace App\Repositories\Interfaces;

interface ModuleRepositoryInterface
{
    public function getModulesById(array $moduleId);

    public function getModulesWithModel();
}