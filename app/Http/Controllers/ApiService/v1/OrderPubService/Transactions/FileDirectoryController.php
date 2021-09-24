<?php

namespace App\Http\Controllers\ApiService\v1\OrderPubService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\OrderPubService\Transactions\FileDirectory;

class FileDirectoryController extends Controller
{
    use ConsumeExternalService;

    public function __construct(FileDirectory $apiService)
    {
        $this->middleware('permission:filedirectory-read|admin', [
            'only' => [
                'getDirectories',
                'showFolders',
                'showFolderContents',
                'showFolderTrashed'
            ]
        ]);
        $this->middleware('permission:filedirectory-create|admin', [
            'only' => [
                'createFolder'
            ]
        ]);
        $this->middleware('permission:filedirectory-update|admin', [
            'only' => [
                'updateFolder',
                'restoreFolder'
            ]
        ]);
        $this->middleware('permission:filedirectory-delete|admin', [
            'only' => [
                'deleteContent'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getDirectories(Request $request)
    {
        return $this->apiService->getDirectories($request->all());
    }

    public function createFolder(Request $request)
    {
        return $this->apiService->createFolder($request->all());
    }

    public function updateFolder(Request $request, $id)
    {
        return $this->apiService->updateFolder($request->all(), $id);
    }

    public function showFolders(Request $request)
    {
        return $this->apiService->showFolders($request->all());
    }

    public function showFolderContents(Request $request)
    {
        return $this->apiService->showFolderContents($request->all());
    }

    public function deleteContent($id)
    {
        return $this->apiService->deleteContent($id);
    }

    public function restoreFolder(Request $request, $id)
    {
        return $this->apiService->restoreFolder($request->all(), $id);
    }

    public function showFolderTrashed(Request $request)
    {
        return $this->apiService->showFolderContents($request->all());
    }
}