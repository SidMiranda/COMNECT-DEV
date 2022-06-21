<?php

$numero = $_GET['numero'];
$status = $_GET['status'];

$servidor = 'http://192.168.20.152/API/update-status.php';

// Parametros da requisição
$content = http_build_query(array(
    'numero' => $numero,
    'status' => $status,
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

if($resposta){
    echo true;
}else{
    echo false;
}

exit;


