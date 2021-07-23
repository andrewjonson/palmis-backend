<?php
namespace App\Repositories\Interfaces;

interface TeamModuleRepositoryInterface
{
    public function unAssignModules(array $moduleId, $teamId);

    public function assignModules($moduleId, $teamId);
}