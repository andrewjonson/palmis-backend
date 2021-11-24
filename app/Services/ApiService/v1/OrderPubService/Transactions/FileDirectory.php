<?php

namespace App\Services\ApiService\v1\OrderPubService\Transactions;

use App\Traits\ConsumeExternalService;

class FileDirectory
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.orderpub.base_url');
        $this->secret = config('services.orderpub.secret');
    }

    public function getDirectories($data)
    {
        return $this->performRequest('GET', '/orderpub/directories',$data);
    }

    public function createFolder($data)
    {
        return $this->performRequest('POST', '/orderpub/directories/folders',$data);
    }

    public function updateFolder($data, $id)
    {
        return $this->performRequest('PUT', '/orderpub/directories/'.$id, $data);
    }

    public function showFolders($data)
    {
        return $this->performRequest('GET', '/orderpub/directories/show-folders',$data);
    }

    public function showFolderContents($data)
    {
        return $this->performRequest('GET', '/orderpub/directories/contents',$data);
    }

    public function deleteContent($id)
    {
        return $this->performRequest('DELETE', '/orderpub/directories/'.$id);
    }

    public function restoreFolder($data, $id)
    {
        return $this->performRequest('PUT', '/orderpub/directories/restore/'.$id, $data);
    }

    public function showFolderTrashed($data)
    {
        return $this->performRequest('GET', '/orderpub/directories/only-trashed',$data);
    }
}