<?php

namespace Onetoweb\WhatsApp\Endpoint\Endpoints;

use Onetoweb\WhatsApp\Endpoint\AbstractEndpoint;

/**
 * Media Endpoint.
 */
class Media extends AbstractEndpoint
{
    /**
     * @param string $filepath
     * 
     * @return array|null
     */
    public function upload(string $filepath): ?array
    {
        return $this->client->upload("/{$this->client->getBusinessId()}/media", $filepath);
    }
}
