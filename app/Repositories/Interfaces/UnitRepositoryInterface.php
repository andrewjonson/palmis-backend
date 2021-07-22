<?php
namespace App\Repositories\Interfaces;

interface UnitRepositoryInterface
{
    public function getUnitByUnitCode($unitCode);

    public function searchUnit($keyword, $rowsPerPage);
}