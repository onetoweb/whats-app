<?php

namespace Onetoweb\WhatsApp\Endpoint\Endpoints;

use Onetoweb\WhatsApp\Endpoint\AbstractEndpoint;
use Onetoweb\WhatsApp\Type;

/**
 * Image Endpoint.
 */
class Image extends AbstractEndpoint
{
    /**
     * @param string $to
     * @param array $data
     * 
     * @return array|null
     */
    public function send(string $to, array $data): ?array
    {
        return $this->client->post("/{$this->client->getBusinessId()}/messages", $this->getAbstractBody(Type\Message::IMAGE, $to, $data));
    }
}
