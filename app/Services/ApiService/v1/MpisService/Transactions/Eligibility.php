<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class Eligibility
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function getEligibility($id)
    {
        return $this->performRequest('GET', '/mpis/show-eligibility/'.$id);
    }

    public function createEligibility($data)
    {
        return $this->performRequest('POST', '/mpis/store-eligibility', $data);
    }

    public function updateEligibility($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/update-eligibility/'.$id, $data);
    }

    public function deleteEligibility($id)
    {
        return $this->performRequest('DELETE', '/mpis/delete-eligibility/'. $id);
    }
}