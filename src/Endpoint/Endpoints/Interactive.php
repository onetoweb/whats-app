<?php

namespace Onetoweb\WhatsApp\Endpoint\Endpoints;

use Onetoweb\WhatsApp\Endpoint\AbstractEndpoint;
use Onetoweb\WhatsApp\Type;

/**
 * Interactive Endpoint.
 */
class Interactive extends AbstractEndpoint
{
    /**
     * @param string $to
     * @param array $data
     * 
     * @return array|null
     */
    public function list(string $to, array $data): ?array
    {
        $data['type'] = Type\Interactive::LIST;
        
        return $this->client->post("/{$this->client->getBusinessId()}/messages", $this->getAbstractBody(Type\Message::INTERACTIVE, $to, $data));
    }
    
    /**
     * @param string $to
     * @param string $message
     * 
     * @return array|null
     */
    public function locationRequest(string $to, string $message): ?array
    {
        return $this->client->post("/{$this->client->getBusinessId()}/messages", $this->getAbstractBody(Type\Message::INTERACTIVE, $to, [
            'type' => Type\Interactive::LOCATION_REQUEST_MESSAGE,
            'body' => [
                'text' => $message,
            ],
            'action' => [
                'name' => 'send_location',
            ],
        ]));
    }
    
    /**
     * @param string $to
     * @param array $data
     * 
     * @return array|null
     */
    public function button(string $to, array $data): ?array
    {
        $data['type'] = Type\Interactive::BUTTON;
        
        return $this->client->post("/{$this->client->getBusinessId()}/messages", $this->getAbstractBody(Type\Message::INTERACTIVE, $to, $data));
    }
    
    /**
     * @param string $to
     * @param array $data
     *
     * @return array|null
     */
    public function cta(string $to, array $data): ?array
    {
        $data['type'] = Type\Interactive::CTA_URL;
        
        return $this->client->post("/{$this->client->getBusinessId()}/messages", $this->getAbstractBody(Type\Message::INTERACTIVE, $to, $data));
    }
}
