<?php

namespace Onetoweb\WhatsApp\Endpoint\Endpoints;

use Onetoweb\WhatsApp\Endpoint\AbstractEndpoint;
use Onetoweb\WhatsApp\Config\Message;

/**
 * Audio Endpoint.
 */
class Audio extends AbstractEndpoint
{
    /**
     * @param string $to
     * @param array $data
     *
     * @return array|null
     */
    public function send(string $to, array $data): ?array
    {
        return $this->client->post("/{$this->client->getBusinessId()}/messages", $this->getAbstractBody(Message::AUDIO, $to, $data));
    }
}
