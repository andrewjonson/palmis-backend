<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class WorkHistory
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function getWorkHistory($id)
    {
        return $this->performRequest('GET', '/mpis/show-work/'. $id);
    }

    public function createWorkHistory($data)
    {
        return $this->performRequest('POST', '/mpis/store-work', $data);
    }

    public function updateWorkHistory($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/update-work/'.$id, $data);
    }

    public function deleteWorkHistory($id)
    {
        return $this->performRequest('DELETE', '/mpis/delete-work/'. $id);
    }

    public function searchWorkHistory($data)
    {
        return $this->performRequest('GET', '/mpis/work-dynamic-search', $data);
    }
}