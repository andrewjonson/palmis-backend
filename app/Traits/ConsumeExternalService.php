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
        $response = Http::$method($base_uri.'/api/'.config('app.version').$requestUrl, $formParams);
        if (isset($token)) {
            $response = Http::withToken($token)->$method($base_uri.'/api/'.config('app.version').$requestUrl, $formParams);
        }
        return response($response->json(), $response->status());
    }
}