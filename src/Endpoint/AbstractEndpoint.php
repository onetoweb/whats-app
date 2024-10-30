<?php

namespace Onetoweb\WhatsApp\Endpoint;

use Onetoweb\WhatsApp\Client;

/**
 * Abstract Endpoint.
 */
abstract class AbstractEndpoint implements EndpointInterface
{
    /**
     * @var Client
     */
    protected $client;
    
    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    
    /**
     * @param string $type
     * @param string $to
     * @param array $data
     * 
     * @return array
     */
    public static function getAbstractBody(string $type, string $to, array $data): array
    {
        return [
            'messaging_product' => 'whatsapp',
            'to' => $to,
            'type' => $type,
            $type => $data
        ];
    }
}
