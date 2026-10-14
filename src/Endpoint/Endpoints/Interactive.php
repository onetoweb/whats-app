<?php

namespace Onetoweb\WhatsApp\Endpoint\Endpoints;

use Onetoweb\WhatsApp\Endpoint\AbstractEndpoint;
use Onetoweb\WhatsApp\Config\{Message, Interactive as InteractiveConfig};

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
        $data['type'] = InteractiveConfig::LIST->value;
        
        return $this->client->post("/{$this->client->getBusinessId()}/messages", $this->getAbstractBody(Message::INTERACTIVE, $to, $data));
    }
    
    /**
     * @param string $to
     * @param string $message
     * 
     * @return array|null
     */
    public function locationRequest(string $to, string $message): ?array
    {
        return $this->client->post("/{$this->client->getBusinessId()}/messages", $this->getAbstractBody(Message::INTERACTIVE, $to, [
            'type' => InteractiveConfig::LOCATION_REQUEST_MESSAGE->value,
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
        $data['type'] = InteractiveConfig::BUTTON->value;
        
        return $this->client->post("/{$this->client->getBusinessId()}/messages", $this->getAbstractBody(Message::INTERACTIVE, $to, $data));
    }
    
    /**
     * @param string $to
     * @param array $data
     *
     * @return array|null
     */
    public function cta(string $to, array $data): ?array
    {
        $data['type'] = InteractiveConfig::CTA_URL->value;
        
        return $this->client->post("/{$this->client->getBusinessId()}/messages", $this->getAbstractBody(Message::INTERACTIVE, $to, $data));
    }
}
