<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class SocialOrganization
{
    use ConsumeExternalService;

    public $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.mpis_base_uri');
    }

    public function getSocialOrg($id)
    {
        return $this->performRequest('GET', '/mpis/show-social-org/'.$id);
    }

    public function createSocialOrg($data)
    {
        return $this->performRequest('POST', '/mpis/store-social-org', $data);
    }
}