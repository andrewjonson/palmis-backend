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

    public function getPersonnelFolders()
    {
        return $this->apiService->getPersonnelFolders();
    }

    public function createPersonnelFolder(Request $request)
    {
        return $this->apiService->createPersonnelFolder($request->all());
    }
}