<?php

namespace App\Services\ApiService\v1\MpfService\Transactions;

use App\Traits\ConsumeExternalService;

class PersonnelFolder
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.mpf.base_url');
        $this->secret = config('services.mpf.secret');
    }

    public function getPersonnelFolderByPmcode($data, $pmcode)
    {
        return $this->performRequest('GET', '/mpf/personnels/folder/'.$pmcode, $data);
    }

    public function getFolders()
    {
        return $this->performRequest('GET', '/mpf/personnels/folders');
    }

    public function createPersonnelFolder($data)
    {
        return $this->performRequest('POST', '/mpf/personnels/folder', $data);
    }

    public function syncPersonnelFolder($data)
    {
        return $this->performRequest('POST','/mpf/personnels/folder/sync', $data);
    }

    public function getPersonnelFolders($pmcode)
    {
        return $this->performRequest('GET', '/mpf/personnels/personnel-folders/'.$pmcode);
    }
}