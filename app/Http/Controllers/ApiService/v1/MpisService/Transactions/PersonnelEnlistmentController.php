<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\PersonnelEnlistment;

class PersonnelEnlistmentController extends Controller
{
    use ConsumeExternalService;

    public function __construct(PersonnelEnlistment $apiService)
    {
        $this->middleware('permission:personnelenlistment-read|admin', [
            'only' => [
                'showPersonnelEnlistmentById',
                'showPersonnelEnlistmentDetailById'
            ]
        ]);
        $this->middleware('permission:personnelenlistment-create|admin', [
            'only' => [
                'createPersonnelReenlistment',
                'createPersonnelEnlistment'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function createPersonnelReenlistment(Request $request)
    {
        return $this->apiService->createPersonnelReenlistment($request->all());
    }

    public function createPersonnelEnlistment(Request $request)
    {
        return $this->apiService->createPersonnelEnlistment($request->all());
    }

    public function showPersonnelEnlistmentById($id)
    {
        return $this->apiService->showPersonnelEnlistmentById($id);
    }

    public function showPersonnelEnlistmentDetailById($id)
    {
        return $this->apiService->showPersonnelEnlistmentDetailById($id);
    }
}