<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\WorkHistory;

class WorkHistoryController extends Controller
{
    use ConsumeExternalService;

    public function __construct(WorkHistory $apiService)
    {
        $this->middleware('permission:workhistory-read|admin', [
            'only' => [
                'getWorkHistory'
            ]
        ]);
        $this->middleware('permission:workhistory-create|admin', [
            'only' => [
                'createWorkHistory'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getWorkHistory($id)
    {
        return $this->apiService->getWorkHistory($id);
    }

    public function createWorkHistory(Request $request)
    {
        return $this->apiService->createWorkHistory($request->all());
    }
}