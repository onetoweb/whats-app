<?php

namespace Onetoweb\WhatsApp;

use Onetoweb\WhatsApp\Endpoint\Endpoints;
use Onetoweb\WhatsApp\Exception\{SignatureException, TokenException, AuthException};
use Onetoweb\WhatsApp\Token;
use Symfony\Component\HttpFoundation\{Request, Response};
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Client as GuzzleCLient;
use GuzzleHttp\Psr7\Utils;
use DateTime;

/**
 * WhatsApp Api Client.
 */
#[\AllowDynamicProperties]
class Client
{
    /**
     * Base href
     */
    public const BASE_HREF = 'https://graph.facebook.com';
    public const AUTH_URL = 'https://graph.facebook.com/oauth/access_token';
    public const DIALOG_URL = 'https://www.facebook.com/%s/dialog/oauth';
    
    /**
     * Methods.
     */
    public const METHOD_POST = 'POST';
    public const METHOD_GET = 'GET';
    
    /**
     * Graph Version.
     */
    public const GRAPH_VERSION = '21.0';
    
    /**
     * @var string
     */
    private $appId;
    
    /**
     * @var string
     */
    private $appSecret;
    
    /**
     * @var string
     */
    private $businessId;
    
    /**
     * @var string
     */
    private $verifyToken;
    
    /**
     * @var string
     */
    private $graphVersion;
    
    /**
     * @var string
     */
    private $redirectUrl;
    
    /**
     * @var Token
     */
    private $token;
    
    /**
     * @param string $appId
     * @param string $apiSecret
     * @param string $businessId
     * @param string $verifyToken = null
     * @param string $graphVersion = self::GRAPH_VERSION
     */
    public function __construct(
        string $appId,
        string $apiSecret,
        string $businessId,
        string $verifyToken = null,
        string $graphVersion = self::GRAPH_VERSION
    ) {
        $this->appId = $appId;
        $this->apiSecret = $apiSecret;
        $this->businessId = $businessId;
        $this->verifyToken = $verifyToken;
        $this->graphVersion = $graphVersion;
        
        // load endpoints
        $this->loadEndpoints();
    }
    
    /**
     * @return void
     */
    private function loadEndpoints(): void
    {
        foreach (Endpoints::list() as $name => $class) {
            $this->{$name} = new $class($this);
        }
    }
    
    /**
     * @param Token $token
     * 
     * @return void
     */
    public function setToken(Token $token): void
    {
        $this->token = $token;
    }
    
    /**
     * @return Token|null
     */
    public function getToken(): ?Token
    {
        return $this->token;
    }
    
    /**
     * @return string|null
     */
    public function getBusinessId(): ?string
    {
        return $this->businessId;
    }
    
    /**
     * @param callable $tokenUpdateCallback
     * 
     * @return void
     */
    public function setTokenUpdateCallback(callable $tokenUpdateCallback): void
    {
        $this->tokenUpdateCallback = $tokenUpdateCallback;
    }
    
    /**
     * @param string $redirectUrl
     * 
     * @return void
     */
    public function setRedirectUrl(string $redirectUrl): void
    {
        $this->redirectUrl = $redirectUrl;
    }
    
    /**
     * @return string
     */
    public function getBaseHref(): string
    {
        return $this->testModus ? self::BASE_HREF_TEST : self::BASE_HREF_LIVE;
    }
    
    /**
     * @return string
     */
    public function getGraphVersion(): string
    {
        return "v{$this->graphVersion}";
    }
    
    /**
     * @param string $redirectUri
     * @param string $state = null
     * 
     * @return string
     */
    public function getAuthorizationUrl(string $redirectUri, string $state = null): string
    {
        return sprintf(self::DIALOG_URL, $this->getGraphVersion()).'?'.http_build_query([
            'client_id' => $this->appId,
            'redirect_uri' => $this->redirectUrl,
            'state' => $state,
            'response_type' => 'code',
            'scope' => 'whatsapp_business_messaging',
        ]);
    }
    
    /**
     * @param string $endpoint
     * 
     * @return string
     */
    public function getUrl(string $endpoint): string
    {
        return implode('/', [
            self::BASE_HREF,
            $this->getGraphVersion(),
            ltrim($endpoint, '/')
        ]);
    }
    
    /**
     * @param string $code
     * 
     * @return void
     */
    public function requestTokenFromCode(string $code): void
    {
        // build options
        $options = [
            RequestOptions::HTTP_ERRORS => false,
            RequestOptions::HEADERS => [
                'accept' => 'application/json'
            ],
            RequestOptions::QUERY => [
                'code' => $code,
                'client_id' => $this->appId,
                'client_secret' => $this->apiSecret,
                'redirect_uri' => $this->redirectUrl,
                'grant_type' => 'authorization_code'
            ]
        ];
        
        // make request
        $response = (new GuzzleCLient())->get(self::AUTH_URL, $options);
        
        // decode json
        $tokenArray = json_decode($response->getBody()->getContents(), true);
        
        // update token
        $this->updateToken($tokenArray);
    }
    
    /**
     * @return void
     */
    public function refreshToken(): void
    {
        // build options
        $options = [
            RequestOptions::HTTP_ERRORS => false,
            RequestOptions::HEADERS => [
                'accept' => 'application/json'
            ],
            RequestOptions::QUERY => [
                'grant_type' => 'fb_exchange_token',
                'client_id' => $this->appId,
                'client_secret' => $this->apiSecret,
                'fb_exchange_token' => (string) $this->token
            ]
        ];
        
        // make request
        $response = (new GuzzleCLient())->get(self::AUTH_URL, $options);
        
        // decode json
        $tokenArray = json_decode($response->getBody()->getContents(), true);
        
        // update token
        $this->updateToken($tokenArray);
    }
    
    /**
     * @param array $tokenArray
     * 
     * @throws TokenException if token response is missing values
     * @throws TokenException if the refresh token is missing
     * 
     * @return void
     */
    public function updateToken(array $tokenArray): void
    {
        // check token array values
        if (!isset($tokenArray['access_token']) or !isset($tokenArray['expires_in'])) {
            throw new TokenException('token response does not contain access_token or expires_in');
        }
        
        // get expires datetime
        $expiresIn = ((int) $tokenArray['expires_in'] - 10);
        $expires = (new DateTime())->modify("+$expiresIn seconds");
        
        // return restricted data token
        $this->token = new Token($tokenArray['access_token'], $expires);
        
        // token update callback
        ($this->tokenUpdateCallback)($this->token);
    }
    
    /**
     * Intercept webhook verification
     * 
     * @param Request $request
     * 
     * @return void
     */
    public function verifyWebhook(Request $request): void
    {
        $hubMode = $request->get('hub_mode', null);
        $hubVerifyToken = $request->get('hub_verify_token', null);
        $hubChallenge = $request->get('hub_challenge', null);
        
        if ($hubMode === 'subscribe') {
            
            if (
                $hubVerifyToken !== null
                and $hubChallenge !== null
                and $this->verifyToken !== null
                and $this->verifyToken === $hubVerifyToken
            ) {
                
                // send 200 verifying the webhook challenge
                $response = new Response($hubChallenge);
                $response->send();
                
            } else {
                
                // send 403 failing the webhook challenge
                $response = new Response();
                $response->setStatusCode(Response::HTTP_FORBIDDEN);
                $response->send();
            }
        }
    }
    
    /**
     * @param Request $request
     * 
     * @throws SignatureException if the signature does not match
     * 
     * @return void
     */
    public function verifySignature(Request $request): void
    {
        if (in_array('sha256', hash_hmac_algos())) {
            
            if ($request->headers->get('x-hub-signature-256') !== 'sha256='.hash_hmac('sha256', $request->getContent(), $this->apiSecret)) {
                throw new SignatureException('x-hub-signature-256 does not match');
            }
            
        } else {
            
            if ($request->headers->get('x-hub-signature') !== 'sha1='.hash_hmac('sha1', $request->getContent(), $this->apiSecret)) {
                throw new SignatureException('x-hub-signature does not match');
            }
        }
    }
    
    /**
     * Listen to incomming webhooks and sends a 200 response
     * 
     * @param callable|null $onSuccess = null
     * 
     * @return void
     */
    public function listen(?callable $onSuccess = null): void
    {
        $request = Request::createFromGlobals();
        
        // check for webhook verify request
        $this->verifyWebhook($request);
        
        // check signature
        $this->verifySignature($request);
        
        // get json
        $json = json_decode($request->getContent(), true);
        
        // on success
        if ($onSuccess) {
            ($onSuccess)($json);
        }
        
        // send 200 response
        (new Response())->send();
    }
    
    /**
     * @param string $endpoint
     * @param array $data = []
     * 
     * @return array
     */
    public function post(string $endpoint, array $data = []): array
    {
        return $this->request(self::METHOD_POST, $endpoint, $data);
    }
    
    /**
     * @param string $endpoint
     * @param array $query = []
     * 
     * @return array
     */
    public function get(string $endpoint, array $query = []): array
    {
        return $this->request(self::METHOD_GET, $endpoint, [], $query);
    }
    
    /**
     * @param string $endpoint
     * @param string $filepath
     * 
     * @return array
     */
    public function upload(string $endpoint, string $filepath): array
    {
        return $this->request(self::METHOD_POST, $endpoint, [], [], $filepath);
    }
    
    /**
     * @param string $method
     * @param string $endpoint
     * @param array $data = []
     * @param array $query = []
     * @param string $filepath = null
     * 
     * @return array
     */
    public function request(string $method, string $endpoint, array $data = [], array $query = [], string $filepath = null): array
    {
        if ($this->token === null) {
            throw new AuthException('you must provide a token with '.self::class.'::setToken, or you can request a token via the authorization workflow');
        }
        
        if ($this->token->isExpired()) {
            $this->refreshToken();
        }
        
        // build options
        $options = [
            RequestOptions::HTTP_ERRORS => false,
            RequestOptions::HEADERS => [
                'Authorization' => "Bearer {$this->token}",
            ],
            RequestOptions::QUERY => $query,
        ];
        
        // add data as json
        if (count($data) > 0) {
            $options[RequestOptions::JSON] = $data;
        }
        
        if ($filepath !== null) {
            
            // add file as multipart form data
            $options[RequestOptions::MULTIPART] = [
                [
                    'name' => 'file',
                    'contents' => Utils::tryFopen($filepath, 'r'),
                ], [
                    'name' => 'messaging_product',
                    'contents' => 'whatsapp',
                ], [
                    'name' => 'type',
                    'contents' => mime_content_type($filepath),
                ]
            ];
        }
        
        // make request
        $response = (new GuzzleCLient())->request($method, $this->getUrl($endpoint), $options);
        
        // decode json
        $json = json_decode($response->getBody()->getContents(), true);
        
        return $json;
    }
}
