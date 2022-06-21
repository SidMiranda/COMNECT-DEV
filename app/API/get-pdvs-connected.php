<?php

$servidor = 'http://192.168.20.152/API/get-pdvs-connected.php';

$context = stream_context_create(array(
    'http' => array(
        'method' => 'POST',
        'header' => "Connection: close\r\n".
                    "Content-type: application/x-www-form-urlencoded"                          
    )
));

// Realize comunicação com o servidor
$contents = file_get_contents($servidor, false, $context);            
$resposta = json_decode($contents); 

echo $contents;

exit;