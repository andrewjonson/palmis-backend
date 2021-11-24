<?php

namespace App\Services\ApiService\v1\MpisService\References;

use App\Traits\ConsumeExternalService;

class ExamType
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.mpis.base_url');
        $this->secret = config('services.mpis.secret');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/mpis/exam-type', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpis/exam-type', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/exam-type/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpis/exam-type/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpis/exam-type/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpis/exam-type/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpis/exam-type/force-delete/'.$id);
    }
}