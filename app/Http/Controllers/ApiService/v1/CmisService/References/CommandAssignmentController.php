<?php

namespace App\Http\Controllers\ApiService\v1\CmisService\References;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\CmisService\References\CommandAssignment;

class CommandAssignmentController extends Controller
{
    use ConsumeExternalService;

    public function __construct(CommandAssignment $apiService)
    {
        $this->middleware('permission:commandassignment-read|admin', [
            'only' => [
                'getCommandAssignmentByCriteriaId'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getCommandAssignmentByCriteriaId(Request $request)
    {
        return $this->apiService->getCommandAssignmentByCriteriaId($request->all());
    }
}