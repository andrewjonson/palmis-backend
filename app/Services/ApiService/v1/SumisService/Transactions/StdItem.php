<?php

namespace App\Services\ApiService\v1\SumisService\Transactions;

use App\Traits\ConsumeExternalService;

class StdItem
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.sumis.base_url');
        $this->secret = config('services.sumis.secret');
    }

    public function createStdItem($data, $id)
    {
        return $this->performRequest('POST', '/sumis/create-std-item/'.$id, $data);
    }

    public function deleteStdItem($id)
    {
        return $this->performRequest('DELETE', '/sumis/delete-std-item/'.$id);
    }
}