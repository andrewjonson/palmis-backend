<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\GovernmentId;

class GovernmentIdController extends Controller
{
    use ConsumeExternalService;

    public function __construct(GovernmentId $apiService)
    {
        $this->middleware('permission:eligibility-read|admin', [
            'only' => [
                'getGovernmentId'
            ]
        ]);
        $this->middleware('permission:eligibility-create|admin', [
            'only' => [
                'createGovernmentId'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getGovernmentId($id)
    {
        return $this->apiService->getGovernmentId($id);
    }

    public function createGovernmentId(Request $request)
    {
        return $this->apiService->createGovernmentId($request->all());
    }
}