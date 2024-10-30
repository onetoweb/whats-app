.. _top:
.. title:: Sticker

`Back to index <index.rst>`_

=======
Sticker
=======

.. contents::
    :local:


Send sticker message
````````````````````

.. code-block:: php
    
    $to = 31612345678;
    $result = $client->sticker->send($to, [
        
        // either media id or media link is required, but not both
        'id' => 1234567890,
        'link' => 'https://www.example.com/sticker.webp',
    ]);


`Back to top <#top>`_