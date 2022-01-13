<?php

namespace App\Services\ApiService\v1\SumisService\Transactions;

use App\Traits\ConsumeExternalService;

class IssuanceDirective
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.sumis.base_url');
        $this->secret = config('services.sumis.secret');
    }

    public function bulkStore($data)
    {
        return $this->performRequest('POST', '/sumis/issuance/create', $data);
    }

    public function getIssuanceDirective($data)
    {
        return $this->performRequest('GET', '/sumis/issuance/get-issuance', $data);
    }

    public function getIssuanceById($id)
    {
        return $this->performRequest('GET', '/sumis/issuance/get-by-id/'.$id);
    }

    public function createItem($data)
    {
        return $this->performRequest('POST', '/sumis/issuance/create-item', $data);
    }

    public function deleteItem($id)
    {
        return $this->performRequest('DELETE', '/sumis/issuance/delete-item/'.$id);
    }

    public function updateIssuanceDirective($data, $id)
    {
        return $this->performRequest('PUT', '/sumis/issuance/update/'.$id, $data);
    }

    public function deleteIssuanceDirective($id)
    {
        return $this->performRequest('DELETE', '/sumis/issuance/delete/'.$id);
    }
}