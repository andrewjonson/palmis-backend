<?php

namespace App\Services\ApiService\v1\SumisService\Transactions;

use App\Traits\ConsumeExternalService;

class StockCard
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.sumis.base_url');
        $this->secret = config('services.sumis.secret');
    }

    public function getList($data)
    {
        return $this->performRequest('GET', '/sumis/stockcard/getlist', $data);
    }

    public function getStockCardById($id)
    {
        return $this->performRequest('GET', '/sumis/stockcard/get-by-id/'.$id);
    }
}