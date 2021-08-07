<?php

namespace App\Services\ApiService\v1\MpfService\Transactions;

use App\Traits\ConsumeExternalService;

class PersonnelFolder
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpf_base_uri');
    }

    public function getPersonnelFolder($data, $pmcode)
    {
        return $this->performRequest('GET', '/mpf/personnels/folder/'.$pmcode, $data);
    }

    public function createPersonnelFolder($data)
    {
        return $this->performRequest('POST', '/mpf/personnels/folder', $data);
    }
}