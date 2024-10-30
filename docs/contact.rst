.. _top:
.. title:: Contact

`Back to index <index.rst>`_

=======
Contact
=======

.. contents::
    :local:


Send a contact message
``````````````````````

.. code-block:: php
    
    $to = 31612345678;
    $result = $client->contact->send($to, [[
        'addresses' => [[
            'street' => 'street number and name',
            'city' => 'city',
            'state' => 'state code',
            'zip' => 'zip code',
            'country' => 'country name',
            'country_code' => 'country code',
            'type' => 'address type'
        ]],
        'birthday' => '2000-01-01',
        'emails' => [[
            'email' => 'email address',
            'type' => 'email type'
        ]],
        'name' => [
            'formatted_name' => 'full name',
            'first_name' => 'first name',
            'last_name' => 'last name',
            'middle_name' => 'middle name',
            'suffix' => 'suffix',
            'prefix' => 'prefix'
        ],
        'org' => [
            'company' => 'company name',
            'department' => 'department name',
            'title' => 'job title'
        ],
        'phones' => [[
            'phone' => 'phone number',
            'type' => 'phone number type',
            'wa_id' => 'whatsapp user id'
        ]],
        'urls' => [[
            'url' => 'website url',
            'type' => 'website type'
        ]]
    ]]);


`Back to top <#top>`_