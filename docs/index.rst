.. title:: Index

===========
Basic Usage
===========

Setup

.. code-block:: php
    
    require 'vendor/autoload.php';
    
    use Onetoweb\WhatsApp\{Client, Token};
    use Symfony\Component\HttpFoundation\Session\Session;
    use Symfony\Component\HttpFoundation\Request;
    
    // start session
    $session = new Session();
    $session->start();
    
    // param
    $appId = '{app_id}';
    $apiSecret = '{api_secret}';
    $businesId = '{busines_id}';
    
    // optional
    $verifyToken = '{verify_token}'; // is needed for verifying webhook callback
    $graphVersion = '21.0'; // omitting graph version the graph version will default to 21.0
    
    // setup client
    $client = new Client(
        $appId,
        $apiSecret,
        $businesId,
        $verifyToken,
        $graphVersion
    );
    
    // set token update callback
    $client->setTokenUpdateCallback(function(Token $token) use ($session) {
        
        // store token
        $session->set('token', [
            'value' => $token->getValue(),
            'expires' => $token->getExpires(),
        ]);
    });
    
    // (optional) set redirect url, required for the authorization workflow
    $redirectUrl = 'https://whats-app.nujob.nl/';
    $client->setRedirectUrl($redirectUrl);
    
    // get request
    $request = Request::createFromGlobals();
    
    /**
     * Authorization workflow
     */
    if ($session->get('token') !== null) {
        
        // load token from storage
        $token = $session->get('token');
        
        // build token
        $token = new Token(
            $token['value'],
            $token['expires']
        );
        
        // set token
        $client->setToken($token);
        
    } elseif ($request->get('code')) {
        
        // request token from code
        $client->requestTokenFromCode($request->get('code'));
        
    } else {
        
        // get authorization url
        $authorizationUrl = $client->getAuthorizationUrl();
        
        // display authorization url
        printf('<a href="%1$s">%1$s</a>', $authorizationUrl);
    }

Setup webhook callback listener

.. code-block:: php
    
    try {
        
        // listing to Whats-App webhooks
        $client->listen(function(?array $contents) {
            
            $contents; // contents of the webhook callback
            
        });
        
    } catch (SignatureException $exception) {
        
        // SignatureException is thrown when the x-hub-signature header does not match the contents
        
    }


=================
Endpoint Examples
=================

* `Text <text.rst>`_
* `Template <template.rst>`_
* `Interactive <interactive.rst>`_
* `Media <media.rst>`_
* `Image <image.rst>`_
* `Audio <audio.rst>`_
* `Document <document.rst>`_
* `Image <image.rst>`_
* `Sticker <sticker.rst>`_
* `Contact <contact.rst>`_
* `Location <location.rst>`_
* `Reaction <reaction.rst>`_

