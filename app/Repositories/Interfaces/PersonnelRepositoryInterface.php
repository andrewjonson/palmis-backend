<?php

namespace App\Repositories\Interfaces;

interface PersonnelRepositoryInterface 
{
    public function validateAfpsnBirthday($afpsn, $birthday);

    public function validateAfpsn($afpsn);
}