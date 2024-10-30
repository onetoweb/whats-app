.. _top:
.. title:: Media

`Back to index <index.rst>`_

=====
Media
=====

.. contents::
    :local:


Upload a media file
```````````````````

.. code-block:: php
    
    $to = 31612345678;
    $result = $client->document->send($to, [
        
        // either media id or media link is required, but not both
        'id' => 1234567890,
        'link' => 'https://www.example.nl/test.pdf',
        
        // (optional)
        'caption' => 'Test Document',
        'filename' => 'test.pdf',
    ]);


`Back to top <#top>`_