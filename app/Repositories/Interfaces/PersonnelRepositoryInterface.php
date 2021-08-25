<?php

namespace App\Repositories\Interfaces;

interface PersonnelRepositoryInterface 
{
    public function validateSerialNumberBirthday($serialNumber, $birthday);

    public function validateSerialNumber($serialNumber);

    public function searchPersonnelBySerialNumber($serialNumber, $rowsPerPage);

    public function getPersonnelByPmcode($pmcode);
}