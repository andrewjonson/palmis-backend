<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\PersonnelDutyAssignment;

class PersonnelDutyAssignmentController extends Controller
{
    use ConsumeExternalService;

    public function __construct(PersonnelDutyAssignment $apiService)
    {
        $this->middleware('permission:personneldutyassignment-read|admin', [
            'only' => [
                'showDutyAssignmentById',
                'showDutyAssignmentDetailById'
            ]
        ]);
        $this->middleware('permission:personneldutyassignment-create|admin', [
            'only' => [
                'createDutyAssignment'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function createDutyAssignment(Request $request)
    {
        return $this->apiService->createDutyAssignment($request->all());
    }

    public function showDutyAssignmentById($id)
    {
        return $this->apiService->showDutyAssignmentById($id);
    }

    public function showDutyAssignmentDetailById($id)
    {
        return $this->apiService->showDutyAssignmentDetailById($id);
    }
}