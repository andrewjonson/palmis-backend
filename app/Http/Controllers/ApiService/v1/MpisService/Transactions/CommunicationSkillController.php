<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\CommunicationSkill;

class CommunicationSkillController extends Controller
{
    use ConsumeExternalService;

    public function __construct(CommunicationSkill $apiService)
    {
        $this->middleware('permission:communicationskill-read|admin', [
            'only' => [
                'getCommunicationSkill'
            ]
        ]);
        $this->middleware('permission:communicationskill-create|admin', [
            'only' => [
                'createCommunicationSkill'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getCommunicationSkill($id)
    {
        return $this->apiService->getCommunicationSkill($id);
    }

    public function createCommunicationSkill(Request $request)
    {
        return $this->apiService->createCommunicationSkill($request->all());
    }
}
