<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class InsuranceRecord
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.mpis.base_url');
        $this->secret = config('services.mpis.secret');
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