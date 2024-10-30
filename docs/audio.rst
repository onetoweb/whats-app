.. _top:
.. title:: Audio

`Back to index <index.rst>`_

=====
Audio
=====

.. contents::
    :local:


Send audio message
``````````````````

.. code-block:: php
    
    $to = 31612345678;
    $result = $client->audio->send($to, [
        
        // either media id or media link is required, but not both
        'id' => 1234567890,
        'link' => 'https://www.example.com/audio.mp3',
    ]);


`Back to top <#top>`_