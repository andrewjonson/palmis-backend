<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\PersonnelRank;

class PersonnelRankController extends Controller
{
    use ConsumeExternalService;

    public function __construct(PersonnelRank $apiService)
    {
        $this->middleware('permission:personnelrank-read|admin', [
            'only' => [
                'searchPersonnelRank'
            ]
        ]);
        $this->middleware('permission:personnelrank-create|admin', [
            'only' => [
                'createPersonnelRank'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function createPersonnelRank(Request $request)
    {
        return $this->apiService->createPersonnelRank($request->all());
    }

    public function searchPersonnelRank(Request $request)
    {
        return $this->apiService->searchPersonnelRank($request->all());
    }
}