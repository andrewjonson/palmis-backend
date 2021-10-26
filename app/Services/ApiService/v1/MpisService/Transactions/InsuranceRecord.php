<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class InsuranceRecord
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');;
    }

    public function showInsurance($id)
    {
        return $this->performRequest('GET', '/mpis/show-insurance/'.$id);
    }

    public function searchInsurance($data)
    {
        return $this->performRequest('GET', '/mpis/insurance-dynamic-search', $data);
    }

    public function updateInsurance($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/update-insurance/'.$id, $data);
    }

    public function deleteInsurance($id)
    {
        return $this->performRequest('DELETE', '/mpis/delete-insurance/'.$id);
    }

    public function storeInsurance($data)
    {
        return $this->performRequest('POST', '/mpis/store-insurance',$data);
    }
}