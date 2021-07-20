<?php
namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait ConsumeExternalService
{
    /**
     * Send request to any service
     * @param $method
     * @param $requestUrl
     * @param array $formParams
     * @param array $headers
     * @return string
     */
    public function performRequest($method, $requestUrl, $formParams = [])
    {
        $base_uri = $this->baseUri;
        $token = request()->bearerToken();
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ])->withToken($token)->$method($base_uri.$requestUrl, $formParams);
        return $response->json();
    }
}