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

    public function updateSocialOrg($data, $id)
    {
        return $this->performRequest('PUT', '/mpis/update-social-org/'.$id, $data);
    }

    public function deleteSocialOrg($id)
    {
        return $this->performRequest('DELETE', '/mpis/delete-social-org/'. $id);
    }
}