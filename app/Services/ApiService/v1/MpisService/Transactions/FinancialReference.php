<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class FinancialReference
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function getFinancialReference($id)
    {
        return $this->performRequest('GET', '/mpis/show-financial/'.$id);
    }

    public function createFinancialReference($data)
    {
        return $this->performRequest('POST', '/mpis/store-financial', $data);
    }

    public function updateFinancial($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/update-financial/'.$id, $data);
    }

    public function deleteFinancial($id)
    {
        return $this->performRequest('DELETE', '/mpis/delete-financial/'. $id);
    }
}