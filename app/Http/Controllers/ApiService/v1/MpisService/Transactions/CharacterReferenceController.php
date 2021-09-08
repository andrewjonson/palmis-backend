<?php

namespace App\Http\Controllers\ApiService\v1\MpisService\Transactions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ConsumeExternalService;
use App\Services\ApiService\v1\MpisService\Transactions\CharacterReference;

class CharacterReferenceController extends Controller
{
    use ConsumeExternalService;

    public function __construct(CharacterReference $apiService)
    {
        $this->middleware('permission:characterreference-read|admin', [
            'only' => [
                'getReference'
            ]
        ]);
        $this->middleware('permission:characterreference-create|admin', [
            'only' => [
                'createReference'
            ]
        ]);
        $this->apiService = $apiService;
    }

    public function getReference($id)
    {
        return $this->apiService->getReference($id);
    }

    public function createReference(Request $request)
    {
        return $this->apiService->createReference($request->all());
    }
}