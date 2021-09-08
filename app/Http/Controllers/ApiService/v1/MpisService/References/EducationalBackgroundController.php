<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\References;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\References\EducationalBackground;

class EducationalBackgroundController extends Controller
{
    use ConsumeExternalService;

    public function __construct(EducationalBackground $apiService)
    {
        $this->middleware('permission:educationalbackground-read|admin', [
            'only' => [
                'getPersonnelEducationBackground'
            ]
        ]);
        $this->middleware('permission:educationalbackground-create|admin', [
            'only' => [
                'createPersonnelEducationBackground'
            ]
        ]);
        $this->middleware('permission:educationalbackground-update|admin', [
            'only' => [
                'updatePersonnelEducationBackground'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getPersonnelEducationBackground($id)
    {
        return $this->apiService->getPersonnelEducationBackground($id);
    }

    public function createPersonnelEducationBackground(Request $request)
    {
        return $this->apiService->createPersonnelEducationBackground($request->all());
    }

    public function updatePersonnelEducationBackground(Request $request, $id)
    {
        return $this->apiService->updatePersonnelEducationBackground($request->all(), $id);
    }
}