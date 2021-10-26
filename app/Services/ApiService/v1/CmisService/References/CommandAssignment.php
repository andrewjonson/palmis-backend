<?php

namespace App\Services\ApiService\v1\CmisService\References;

use App\Traits\ConsumeExternalService;

class CommandAssignment
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.cmis_base_uri');
    }

    public function getCommandAssignmentByCriteriaId($data)
    {
        return $this->performRequest('GET', '/cmis/search/command-assignment', $data);
    }
}