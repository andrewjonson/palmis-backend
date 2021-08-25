<?php
namespace App\Repositories\Eloquent;

use App\Models\Personnel;
use App\Repositories\Eloquent\BaseRepository;
use App\Repositories\Interfaces\PersonnelRepositoryInterface;

class PersonnelRepository extends BaseRepository implements PersonnelRepositoryInterface
{
    public function __construct(Personnel $model)
    {
        $this->model = $model;
    }

    public function validateSerialNumberBirthday($serialNumber, $birthday)
    {
        return $this->model->where('afpsn', $serialNumber)->where('birthday', $birthday)->first();
    }

    public function validateSerialNumber($serialNumber) 
    {
        return $this->model->where('serial_number', $serialNumber)->first();
    }

    public function searchPersonnelBySerialNumber($serialNumber, $rowsPerPage)
    {
        return $this->model->where('serial_number', 'like', $serialNumber.'%')->paginate($rowsPerPage);
    }

    public function getPersonnelByPmcode($pmcode)
    {
        return $this->model->where('PMCode', $pmcode)->first();
    }
}