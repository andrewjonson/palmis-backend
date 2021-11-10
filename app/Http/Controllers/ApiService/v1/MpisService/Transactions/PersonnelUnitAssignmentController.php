<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\PersonnelUnitAssignment;

class PersonnelUnitAssignmentController extends Controller
{
    use ConsumeExternalService;

    public function __construct(PersonnelUnitAssignment $apiService)
    {
        $this->middleware('permission:personnelunitassignment-read|admin', [
            'only' => [
                'showUnitAssignmentById',
                'showUnitAssignmentDetailById'
            ]
        ]);
        $this->middleware('permission:personnelunitassignment-create|admin', [
            'only' => [
                'createUnitAssignment'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function createUnitAssignment(Request $request)
    {
        return $this->apiService->createUnitAssignment($request->all());
    }

    public function showUnitAssignmentById($id)
    {
        return $this->apiService->showUnitAssignmentById($id);
    }

    public function showUnitAssignmentDetailById($id)
    {
        return $this->apiService->showUnitAssignmentDetailById($id);
    }
}