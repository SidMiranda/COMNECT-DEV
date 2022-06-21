<?php

$pdv = $_GET['pdv'];
$status = $_GET['status'];

$servidor = 'http://192.168.20.152/API/insert-pdv-status-stress.php';

// Parametros da requisição
$content = http_build_query(array(
    'pdv' => $pdv,
    'status' => $status
));

$context = stream_context_create(array(
    'http' => array(
        'method' => 'POST',
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