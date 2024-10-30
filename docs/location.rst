.. _top:
.. title:: Location

`Back to index <index.rst>`_

========
Location
========

.. contents::
    :local:


Send location message
`````````````````````

.. code-block:: php
    
    $to = 31612345678;
    $result = $client->location->send($to, [
        'latitude' => '37.44216251868683',
        'longitude' => '-122.16153582049394',
        'name' => 'location name',
        'address' => 'location address',
    ]);


`Back to top <#top>`_