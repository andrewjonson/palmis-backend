<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\FamilyHistory;

class FamilyHistoryController extends Controller
{
    use ConsumeExternalService;

    public function __construct(FamilyHistory $apiService)
    {
        $this->middleware('permission:familyhistory-read|admin', [
            'only' => [
                'showFamilyHistoryById'
            ]
        ]);
        $this->middleware('permission:familyhistory-create|admin', [
            'only' => [
                'createFamilyHistory'
            ]
        ]);
        $this->middleware('permission:familyhistory-update|admin', [
            'only' => [
                'updateFamilyHistory'
            ]
        ]);
        $this->middleware('permission:familyhistory-delete|admin', [
            'only' => [
                'deleteFamily'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function showFamilyHistoryById($id)
    {
        return $this->apiService->showFamilyHistoryById($id);
    }

    public function createFamilyHistory(Request $request)
    {
        return $this->apiService->createFamilyHistory($request->all());
    }

    public function updateFamilyHistory(Request $request, $id)
    {
        return $this->apiService->updateFamilyHistory($request->all(), $id);
    }

    public function deleteFamily($id)
    {
        return $this->apiService->deleteFamily($id);
    }
}