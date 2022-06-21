<?php

$numero = rand(0, 1000);
$valor = $_GET['valor'];
$pagamento = $_GET['pagamento'];
$status = 'pendente';
$data = date('d/m/Y');
$pdv = $_GET['pdv'] ?? 0;

$servidor = 'http://192.168.20.152/API/insert.php';

// Parametros da requisição
$content = http_build_query(array(
    'numero' => $numero,
    'valor' => $valor,
    'pagamento' => $pagamento,
    'status' => $status,
    'data' => $data, 
    'pdv' => $pdv
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

