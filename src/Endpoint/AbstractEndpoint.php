<?php

namespace Onetoweb\WhatsApp\Endpoint;

use Onetoweb\WhatsApp\Client;
use Onetoweb\WhatsApp\Config\Message;

/**
 * Abstract Endpoint.
 */
abstract class AbstractEndpoint implements EndpointInterface
{
    /**
     * @param Client $client
     */
    public function __construct(
        protected Client $client
    ) {
        
    }
    
    /**
     * @param Message $type
     * @param string $to
     * @param array $data
     * 
     * @return array
     */
    public static function getAbstractBody(Message $type, string $to, array $data): array
    {
        return [
            'messaging_product' => 'whatsapp',
            'to' => $to,
            'type' => $type->value,
            $type->value => $data
        ];
    }
}
