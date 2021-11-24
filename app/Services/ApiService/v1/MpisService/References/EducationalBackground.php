<?php

namespace App\Services\ApiService\v1\MpisService\References;

use App\Traits\ConsumeExternalService;

class EducationalBackground
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.mpis.base_url');
        $this->secret = config('services.mpis.secret');
    }

    public function getPersonnelEducationBackground($id)
    {
        return $this->performRequest('GET', '/mpis/show-education/'.$id);
    }

    public function createPersonnelEducationBackground($data)
    {
        return $this->performRequest('POST', '/mpis/store-education', $data);
    }

    public function updatePersonnelEducationBackground($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/update-education/'.$id, $data);
    }

}