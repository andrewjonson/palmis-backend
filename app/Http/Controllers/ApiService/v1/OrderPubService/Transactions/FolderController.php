<?php

namespace App\Http\Controllers\ApiService\v1\OrderPubService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\OrderPubService\Transactions\Folder;

class FolderController extends Controller
{
    use ConsumeExternalService;

    public function __construct(Folder $apiService)
    {
        $this->middleware('permission:folder-read|admin', [
            'only' => [
                'getFolder',
                'getFolderWithTemplate',
                'getFolderbyCategory',
                'getFolderContent'
            ]
        ]);
        $this->middleware('permission:folder-create|admin', [
            'only' => [
                'createFolder',
                'createSubFolder',
                'storeTemplateToFolder'
            ]
        ]);
        $this->middleware('permission:folder-update|admin', [
            'only' => [
                'updateFolder'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getFolder(Request $request)
    {
        return $this->apiService->getFolder($request->all());
    }

    public function getFolderWithTemplate($id)
    {
        return $this->apiService->getFolderWithTemplate($id);
    }

    public function createFolder(Request $request)
    {
        return $this->apiService->createFolder($request->all());
    }

    public function updateFolder(Request $request, $id)
    {
        return $this->apiService->updateFolder($request->all(), $id);
    }

    public function createSubFolder(Request $request, $id)
    {
        return $this->apiService->createSubFolder($request->all(), $id);
    }

    public function storeTemplateToFolder(Request $request, $id)
    {
        return $this->apiService->storeTemplateToFolder($request->all(), $id);
    }

    public function getFolderbyCategory($id)
    {
        return $this->apiService->getFolderbyCategory($id);
    }

    public function getFolderContent($id)
    {
        return $this->apiService->getFolderContent($id);
    }
}