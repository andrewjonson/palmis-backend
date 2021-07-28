<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Traits\RestfulApiServiceControllerTrait;
use App\Services\ApiService\v1\MpisService\Transactions\Personnel;

class PersonnelController extends Controller
{
    use ConsumeExternalService, RestfulApiServiceControllerTrait;

    public function __construct(Personnel $apiService)
    {
        $this->middleware('permission:personnel-read|admin', [
            'only' => [
                'index',
                'onlyTrashed'
            ]
        ]);
        $this->middleware('permission:personnel-create|admin', [
            'only' => [
                'store'
            ]
        ]);
        $this->middleware('permission:personnel-update|admin', [
            'only' => [
                'update',
                'restore'
            ]
        ]);
        $this->middleware('permission:personnel-delete|admin', [
            'only' => [
                'delete',
                'forceDelete'
            ]
        ]);
        $this->apiService = $apiService;
    }
}