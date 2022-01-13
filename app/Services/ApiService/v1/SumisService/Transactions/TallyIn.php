<?php

namespace App\Services\ApiService\v1\SumisService\Transactions;

use App\Traits\ConsumeExternalService;

class TallyIn
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.sumis.base_url');
        $this->secret = config('services.sumis.secret');
    }

    public function bulkStoreTallyIn($data)
    {
        return $this->performRequest('POST', '/sumis/tally-in/store', $data);
    }

    public function getTallyIn($data)
    {
        return $this->performRequest('GET', '/sumis/tally-in', $data);
    }

    public function printTallyIn($id)
    {
        return $this->performRequest('GET', '/sumis/print-tally-in/'.$id);
    }

    public function getFilterTally($data)
    {
        return $this->performRequest('GET', '/sumis/filter-tally', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/sumis/tally/update-tally-in/'.$id, $data);
    }

    public function deleteTallyIn($id)
    {
        return $this->performRequest('DELETE', '/sumis/tally/delete-tally-in/'.$id);
    }
}