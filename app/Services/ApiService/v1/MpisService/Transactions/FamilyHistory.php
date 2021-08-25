<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class FamilyHistory
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function showFamilyHistoryById($id)
    {
        return $this->performRequest('GET', '/mpis/show-family/'.$id);
    }

    public function createFamilyHistory($data)
    {
        return $this->performRequest('POST', '/mpis/store-family', $data);
    }

    public function updateFamilyHistory($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/update-family/'.$id, $data);
    }

    public function deleteFamily($id)
    {
        return $this->performRequest('DELETE', '/mpis/delete-family/'.$id);
    }

}