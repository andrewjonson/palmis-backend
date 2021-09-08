<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\CivilianCommendation;

class CivilianCommendationController extends Controller
{
    use ConsumeExternalService;

    public function __construct(CivilianCommendation $apiService)
    {
        $this->middleware('permission:civiliancommendation-read|admin', [
            'only' => [
                'getCommendation'
            ]
        ]);
        $this->middleware('permission:civiliancommendation-create|admin', [
            'only' => [
                'createCommendation'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getCommendation($id)
    {
        return $this->apiService->getCommendation($id);
    }

    public function createCommendation(Request $request)
    {
        return $this->apiService->createCommendation($request->all());
    }

}