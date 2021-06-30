<?php
namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    public function successResponse($message, $errorCode)
    {
        return new JsonResponse([
            'type' => 1,
            'message' => $message
        ], $errorCode);
    }

    public function failedResponse($message, $errorCode)
    {
        return new JsonResponse([
            'type' => 2,
            'message' => $message
        ], $errorCode);
    }
}