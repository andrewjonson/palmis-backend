<?php

namespace App\Http\Controllers\ApiService\v1\ToeisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\ToeisService\Transactions\TaskOrganization;

class TaskOrganizationController extends Controller
{
    use ConsumeExternalService;

    public function __construct(TaskOrganization $apiService)
    {
        $this->middleware('permission:taskorganization-create|admin', [
            'only' => [
                'createTaskOrg'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function createTaskOrg(Request $request)
    {
        return $this->apiService->createTaskOrg($request->all());
    }
}