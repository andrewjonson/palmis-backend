<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\PersonnelUnit;

class PersonnelUnitController extends Controller
{
    use ConsumeExternalService;

    public function __construct(PersonnelUnit $apiService)
    {
        $this->middleware('permission:personnelunit-create|admin', [
            'only' => [
                'createPersonnelUnit'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function createPersonnelUnit(Request $request)
    {
        return $this->apiService->createPersonnelUnit($request->all());
    }
}