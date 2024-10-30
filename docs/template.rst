.. _top:
.. title:: Interactive

`Back to index <index.rst>`_

===========
Interactive
===========

.. contents::
    :local:


Get Template
````````````

.. code-block:: php
    
    $id = 123456789;
    $result = $client->template->get($id);


Send template message
`````````````````````

.. code-block:: php
    
    $to = 31612345678;
    $result = $client->template->send($to, [
        'name' => 'template_name',
        'language' => [
            'code' => 'en'
        ],
        'components' => [
            [
                'type' => 'header',
                'sub_type' => '',
                'index' => 0,
                'parameters' => [[
                    'type' => 'text',
                    'text' => 'new template'
                ]]
            ], [
                'type' => 'body',
                'sub_type' => '',
                'index' => 0,
                'parameters' => [[
                    'type' => 'text',
                    'text' => 'name'
                ], [
                    'type' => 'text',
                    'text' => 'hello world'
                ]]
            ], [
                'type' => 'button',
                'sub_type' => 'url',
                'index' => 0,
                'parameters' => [[
                    'type' => 'text',
                    'text' => 'test.html'
                ]]
            ], [
                'type' => 'button',
                'sub_type' => 'copy_code',
                'index' => 2,
                'parameters' => [[
                    'type' => 'coupon_code',
                    'coupon_code' => 'AAAAA'
                ]]
            ]
        ]
    ]);


`Back to top <#top>`_