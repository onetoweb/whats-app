.. _top:
.. title:: Image

`Back to index <index.rst>`_

=====
Image
=====

.. contents::
    :local:


Send image message
``````````````````

.. code-block:: php
    
    $to = 31612345678;
    $result = $client->image->send($to, [
        
        // either media id or media link is required, but not both
        'id' => 1234567890,
        'link' => 'https://www.example.com/image.png',
        
        // (optional)
        'caption' => 'image caption'
    ]);


`Back to top <#top>`_