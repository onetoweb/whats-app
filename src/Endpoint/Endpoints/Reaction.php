<?php

namespace Onetoweb\WhatsApp\Endpoint\Endpoints;

use Onetoweb\WhatsApp\Endpoint\AbstractEndpoint;
use Onetoweb\WhatsApp\Type;

/**
 * Reaction Endpoint.
 */
class Reaction extends AbstractEndpoint
{
    /**
     * @param string $to
     * @param string $messageId
     * @param string $emoji
     * 
     * @return array|null
     */
    public function send(string $to, string $messageId, string $emoji): ?array
    {
        return $this->client->post("/{$this->client->getBusinessId()}/messages", $this->getAbstractBody(Type\Message::REACTION, $to, [
            'message_id' => $messageId,
            'emoji' => $emoji
        ]));
    }
}
