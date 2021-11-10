<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\PersonnelPromotion;

class PersonnelPromotionController extends Controller
{
    use ConsumeExternalService;

    public function __construct(PersonnelPromotion $apiService)
    {
        $this->middleware('permission:personnelpromotion-read|admin', [
            'only' => [
                'showPersonnelPromotion',
                'showOrderPromotionDetail'
            ]
        ]);
        $this->middleware('permission:personnelpromotion-create|admin', [
            'only' => [
                'createPersonnelPromotion'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function createPersonnelPromotion(Request $request)
    {
        return $this->apiService->createPersonnelPromotion($request->all());
    }

    public function showPersonnelPromotion($id)
    {
        return $this->apiService->showPersonnelPromotion($id);
    }

    public function showOrderPromotionDetail($id)
    {
        return $this->apiService->showOrderPromotionDetail($id);
    }
}