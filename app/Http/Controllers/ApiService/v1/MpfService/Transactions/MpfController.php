<?php

namespace App\Http\Controllers\ApiService\v1\MpfService\Transactions;

use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Traits\RestfulApiServiceControllerTrait;
use App\Services\ApiService\v1\MpfService\Transactions\Mpf;

class MpfController extends Controller
{
    use ConsumeExternalService, RestfulApiServiceControllerTrait;

    public function __construct(Mpf $apiService)
    {
        $this->middleware('permission:mpf-read|admin', [
            'only' => [
                'index',
                'onlyTrashed'
            ]
        ]);
        $this->middleware('permission:mpf-create|admin', [
            'only' => [
                'store'
            ]
        ]);
        $this->middleware('permission:mpf-update|admin', [
            'only' => [
                'update',
                'restore'
            ]
        ]);
        $this->middleware('permission:mpf-delete|admin', [
            'only' => [
                'delete',
                'forceDelete'
            ]
        ]);
        $this->apiService = $apiService;
    }
}