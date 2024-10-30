.. _top:
.. title:: Text

`Back to index <index.rst>`_

====
Text
====

.. contents::
    :local:


Send text message
`````````````````

.. code-block:: php
    
    $to = 31612345678;
    $result = $client->text->send($to, [
        'preview_url' => true,
        'body' => 'hello world',
    ]);


`Back to top <#top>`_