<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\PersonnelAward;

class PersonnelAwardController extends Controller
{
    use ConsumeExternalService;

    public function __construct(PersonnelAward $apiService)
    {
        $this->middleware('permission:personnelaward-read|admin', [
            'only' => [
                'showPersonnelAward',
                'getAppurtenance'
            ]
        ]);
        $this->middleware('permission:personnelaward-create|admin', [
            'only' => [
                'createPersonnelAward'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function createPersonnelAward(Request $request)
    {
        return $this->apiService->createPersonnelAward($request->all());
    }

    public function showPersonnelAward($id)
    {
        return $this->apiService->showPersonnelAward($id);
    }

    public function getAppurtenance(Request $request)
    {
        return $this->apiService->getAppurtenance($request->all());
    }
}