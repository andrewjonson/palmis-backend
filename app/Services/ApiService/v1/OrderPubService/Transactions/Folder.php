<?php

namespace App\Services\ApiService\v1\OrderPubService\Transactions;

use App\Traits\ConsumeExternalService;

class Folder
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.orderpub.base_url');
        $this->secret = config('services.orderpub.secret');
    }

    public function getFolder($data)
    {
        return $this->performRequest('GET', '/orderpub/folders',$data);
    }

    public function getFolderWithTemplate($id)
    {
        return $this->performRequest('GET', '/orderpub/folders/templates/'.$id);
    }

    public function createFolder($data)
    {
        return $this->performRequest('POST', '/orderpub/folders', $data);
    }

    public function updateFolder($data, $id)
    {
        return $this->performRequest('POST', '/orderpub/folders/'.$id, $data);
    }

    public function createSubFolder($data, $id)
    {
        return $this->performRequest('POST', '/orderpub/folders/'.$id, $data);
    }

    public function storeTemplateToFolder($data, $id)
    {
        return $this->performRequest('POST', '/orderpub/folders/store-templates/'.$id, $data);
    }

    public function getFolderbyCategory($data)
    {
        return $this->performRequest('GET', '/orderpub/folders/categories', $data);
    }

    public function getFolderContent($data)
    {
        return $this->performRequest('GET', '/orderpub/folders/content', $data);
    }

}