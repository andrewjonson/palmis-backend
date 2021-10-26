<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\SocialOrganization;

class SocialOrganizationController extends Controller
{
    use ConsumeExternalService;

    public function __construct(SocialOrganization $apiService)
    {
        $this->middleware('permission:socialorganization-read|admin', [
            'only' => [
                'getSocialOrg'
            ]
        ]);
        $this->middleware('permission:socialorganization-create|admin', [
            'only' => [
                'createSocialOrg'
            ]
        ]);
        $this->middleware('permission:socialorganization-update|admin', [
            'only' => [
                'updateSocialOrg'
            ]
        ]);
        $this->middleware('permission:socialorganization-delete|admin', [
            'only' => [
                'deleteSocialOrg'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getSocialOrg($id)
    {
        return $this->apiService->getSocialOrg($id);
    }

    public function createSocialOrg(Request $request)
    {
        return $this->apiService->createSocialOrg($request->all());
    }

    public function updateSocialOrg(Request $request, $id)
    {
        return $this->apiService->updateSocialOrg($request->all(), $id);
    }

    public function deleteSocialOrg($id)
    {
        return $this->apiService->deleteSocialOrg($id);
    }
}