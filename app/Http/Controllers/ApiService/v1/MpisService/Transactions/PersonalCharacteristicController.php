<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\PersonalCharacteristic;

class PersonalCharacteristicController extends Controller
{
    use ConsumeExternalService;

    public function __construct(PersonalCharacteristic $apiService)
    {
        $this->middleware('permission:personalcharacteristic-read|admin', [
            'only' => [
                'index',
                'onlyTrashed'
            ]
        ]);
        $this->middleware('permission:personalcharacteristic-create|admin', [
            'only' => [
                'store'
            ]
        ]);

        $this->apiService = $apiService;
    }

    public function getPersonalCharacteristicById($id)
    {
        return $this->apiService->getPersonalCharacteristicById($id);
    }

    public function createPersonalCharacteristic(Request $request)
    {
        return $this->apiService->createPersonalCharacteristic($request->all());
    }
}