.. _top:
.. title:: Interactive

`Back to index <index.rst>`_

===========
Interactive
===========

.. contents::
    :local:


Send list message
`````````````````

.. code-block:: php
    
    $to = 31612345678;
    $result = $client->interactive->list($to, [
        'header' => [
            'type' => 'text',
            'text' => 'header text',
        ],
        'body' => [
            'text' => 'body text',
        ],
        'footer' => [
            'text' => 'footer text'
        ],
        'action' => [
            'sections' => [[
                'title' => 'section title',
                'rows' => [[
                    'id' => 'A',
                    'title' => 'Option A',
                    'description' => 'for option A'
                ], [
                    'id' => 'B',
                    'title' => 'Option B',
                    'description' => 'for option B'
                ], [
                    'id' => 'C',
                    'title' => 'Option C',
                    'description' => 'for option C'
                ]]
            ]],
           'button' => 'button text',
        ]
    ]);


Send location request message
`````````````````````````````

.. code-block:: php
    
    $to = 31612345678;
    $message = 'can you share your location';
    $result = $client->interactive->locationRequest($to, $message);


Send interactive button message
```````````````````````````````

.. code-block:: php
    
    $to = 31612345678;
    $result = $client->interactive->button($to, [
        'header' => [
            'type' => 'text',
            'text' => 'Header text'
        ],
        'body' => [
            'text' => 'Hello world'
        ],
        'footer' => [
            'text' => 'Footer text'
        ],
        'action' => [
            'buttons' => [[
                'type' => 'reply',
                'reply' => [
                    'id' => 'id',
                    'title' => 'Reply'
                ]]
            ]
        ]
    ]);


Send Call-to-Action URL Button message
``````````````````````````````````````

.. code-block:: php
    
    $to = 31612345678;
    $result = $client->interactive->cta($to, [
        'header' => [
            'type' => 'text',
            'text' => 'header text'
        ],
        'body' => [
            'text' => 'body text'
        ],
        'footer' => [
            'text' => 'footer text'
        ],
        'action' => [
            'name' => 'cta_url',
            'parameters' => [
                'display_text' => 'button text',
                'url' => 'https://www.example.com/'
            ]
        ]
    ]);


`Back to top <#top>`_