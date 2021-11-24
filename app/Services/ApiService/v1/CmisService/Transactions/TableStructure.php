<?php

namespace App\Services\ApiService\v1\CmisService\Transactions;

use App\Traits\ConsumeExternalService;

class TableStructure
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.cmis.base_url');
        $this->secret = config('services.cmis.secret');
    }

    public function getTableStructureByCriteria($data)
    {
        return $this->performRequest('GET', '/cmis/search/table-structure', $data);
    }
}