<?php

namespace App\Http\Controllers\ApiService\v1\MpfService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpfService\Transactions\PersonnelProfile;

class PersonnelProfileController extends Controller
{
    use ConsumeExternalService;

    public function __construct(PersonnelProfile $apiService)
    {
        $this->middleware('permission:personnelprofile-read|admin', [
            'only' => [
                'index',
                'onlyTrashed'
            ]
        ]);
        $this->middleware('permission:personnelprofile-create|admin', [
            'only' => [
                'store'
            ]
        ]);
        $this->middleware('permission:personnelprofile-update|admin', [
            'only' => [
                'update',
                'restore'
            ]
        ]);
        $this->middleware('permission:personnelprofile-delete|admin', [
            'only' => [
                'delete',
                'forceDelete'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getProfile($id)
    {
        return $this->apiService->getProfile($id);
    }

    public function addProfile(Request $request)
    {
        return $this->apiService->addProfile($request->all());
    }
}