<?php

namespace App\Services\ApiService\v1\MpisService\References;

use App\Traits\ConsumeExternalService;

class Zipcode
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function index($data)
    {
        return $this->performRequest('GET', '/mpis/zipcodes', $data);
    }

    public function store($data)
    {
        return $this->performRequest('POST', '/mpis/zipcodes', $data);
    }

    public function update($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/zipcodes/'.$id, $data);
    }

    public function delete($id)
    {
        return $this->performRequest('DELETE', '/mpis/zipcodes/'.$id);
    }

    public function onlyTrashed($data)
    {
        return $this->performRequest('GET', '/mpis/zipcodes/only-trashed', $data);
    }

    public function restore($id)
    {
        return $this->performRequest('PUT', '/mpis/zipcodes/restore/'.$id);
    }

    public function forceDelete($id)
    {
        return $this->performRequest('DELETE', '/mpis/zipcodes/force-delete/'.$id);
    }


    public function getZipcode($data)
    {
        return $this->performRequest('GET', '/mpis/get-zipcode',$data);
    }

}