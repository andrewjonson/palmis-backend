<?php

namespace App\Http\Controllers\ApiService\v1\MpfService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ApiService\v1\MpfService\Transactions\PersonnelFolder;

class PersonnelFolderController extends Controller
{
    public function __construct(PersonnelFolder $apiService)
    {
        $this->middleware('permission:personnelfolder-read|admin', [
            'only' => [
                'getPersonnelFolder'
            ]
        ]);
        $this->middleware('permission:personnelfolder-create|admin', [
            'only' => [
                'createPersonnelFolder'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getPersonnelFolderByPmcode(Request $request, $pmcode)
    {
        return $this->apiService->getPersonnelFolderByPmcode($request->all(), $pmcode);
    }

    public function getFolders()
    {
        return $this->apiService->getFolders();
    }

    public function createPersonnelFolder(Request $request)
    {
        return $this->apiService->createPersonnelFolder($request->all());
    }

    public function syncPersonnelFolder(Request $request)
    {
        return $this->apiService->syncPersonnelFolder($request->all());
    }

    public function getPersonnelFolders($pmcode)
    {
        return $this->apiService->getPersonnelFolders($pmcode);
    }
}