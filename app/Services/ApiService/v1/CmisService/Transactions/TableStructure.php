<?php

namespace App\Services\ApiService\v1\CmisService\Transactions;

use App\Traits\ConsumeExternalService;

class TableStructure
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.cmis_base_uri');
    }

    public function getTableStructureByCriteria($data)
    {
        return $this->performRequest('GET', '/cmis/search/table-structure', $data);
    }
}