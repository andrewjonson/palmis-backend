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

    public function validateAfpsnBirthday($afpsn, $birthday)
    {
        return $this->model->where('afpsn', $afpsn)->where('birthday', $birthday)->first();
    }

    public function validateAfpsn($afpsn) 
    {
        return $this->model->where('afpsn', $afpsn)->first();
    }

    public function searchPersonnelByAfpsn($afpsn, $rowsPerPage)
    {
        return $this->model->where('afpsn', 'like', $afpsn.'%')->paginate($rowsPerPage);
    }

    public function getPersonnelByPmcode($pmcode)
    {
        return $this->model->where('PMCode', $pmcode)->first();
    }
}