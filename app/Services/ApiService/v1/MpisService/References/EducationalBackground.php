<?php

namespace App\Services\ApiService\v1\MpisService\References;

use App\Traits\ConsumeExternalService;

class EducationalBackground
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
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