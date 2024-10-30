.. _top:
.. title:: Reaction

`Back to index <index.rst>`_

========
Reaction
========

.. contents::
    :local:


Send reaction emoji
`````````````````````

.. code-block:: php
    
    $to = 31612345678;
    $messageId = 'wamid.aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';
    $emoji = '👍';
    $result = $client->reaction->send($to, $messageId, $emoji);


`Back to top <#top>`_