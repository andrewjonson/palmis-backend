<?php

namespace App\Services\ApiService\v1\MpfService\Transactions;

use App\Traits\ConsumeExternalService;

class PersonnelProfile
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpf_base_uri');
    }

    public function getProfile($id)
    {
        return $this->performRequest('GET', '/api/v1/mpf/personnels/profiles/'.$id);
    }

    public function addProfile($data)
    {
        return $this->performRequest('POST', '/api/v1/mpf/personnels/profiles/add', $data);
    }
}