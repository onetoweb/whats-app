<?php

namespace Onetoweb\WhatsApp\Endpoint\Endpoints;

use Onetoweb\WhatsApp\Endpoint\AbstractEndpoint;
use Onetoweb\WhatsApp\Type;

/**
 * Text Endpoint.
 */
class Text extends AbstractEndpoint
{
    /**
     * @param int $to
     * @param array $data
     * 
     * @return array|null
     */
    public function send(int $to, array $data): ?array
    {
        return $this->client->post("/{$this->client->getBusinessId()}/messages", $this->getAbstractBody(Type\Message::TEXT, $to, $data));
    }
}