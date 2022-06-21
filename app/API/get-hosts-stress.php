<?php

$servidor = 'http://192.168.20.152/API/get-hosts-stress.php';

$ip = $_GET['ip'];

// Parametros da requisição
$content = http_build_query(array(
    'ip' => $ip
));

$context = stream_context_create(array(
    'http' => array(
        'method' => 'PUT',
        'header' => "Connection: close\r\n".
                    "Content-type: application/x-www-form-urlencoded\r\n".
                    "Content-Length: ".strlen($content)."\r\n",
        'content' => $content                            
    )
));

// Realize comunicação com o servidor
$contents = file_get_contents($servidor, false, $context);            
$resposta = json_decode($contents); 

echo $resposta;

exit;