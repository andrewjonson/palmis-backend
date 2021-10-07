<?php

namespace App\Services\ApiService\v1\MpisService\References;

use App\Traits\ConsumeExternalService;

class Course
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/mpis/course', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpis/course', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/course/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpis/course/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpis/course/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpis/course/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpis/course/force-delete/'.$id);
    }

    public function getCourseByType($data)
    {
        return $this->performRequest('GET', '/mpis/course-type', $data);
    }

    public function getCourseByLevel($data)
    {
        return $this->performRequest('GET', '/mpis/course-by-level', $data);
    }
}