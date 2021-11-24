<?php

namespace App\Services\ApiService\v1\MpisService\Transactions;

use App\Traits\ConsumeExternalService;

class SocialOrganization
{
    use ConsumeExternalService;

    public $baseUrl;
    public $secret;

    public function __construct()
    {
        $this->baseUrl = config('services.mpis.base_url');
        $this->secret = config('services.mpis.secret');
    }

    public function getSocialOrg($id)
    {
        return $this->performRequest('GET', '/mpis/show-social-org/'.$id);
    }

    public function createSocialOrg($data)
    {
        return $this->performRequest('POST', '/mpis/store-social-org', $data);
    }

    public function updateSocialOrg($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/update-social-org/'.$id, $data);
    }

    public function deleteSocialOrg($id)
    {
        return $this->performRequest('DELETE', '/mpis/delete-social-org/'. $id);
    }
}