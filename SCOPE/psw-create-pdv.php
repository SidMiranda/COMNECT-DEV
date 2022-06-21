<?php

//auth_key_rest_api=dC4h71G518Wwg12wj21R24O3M3IlYKmi

//$ip = $_GET["ip"];
//$req = $_GET["req"];

$url = "https://192.168.20.197:8085/scope/rest/terminal/";
$token = "dC4h71G518Wwg12wj21R24O3M3IlYKmi";

$postdata = http_build_query(
    array('codEmpresa' => '0001',
            'codLoja' => '0001',
            'codTerminal' => '021',
            'codPerfilHardware' => '003',
            'codPerfilServico' => '236'
    )
);

$opts = array('http' => array(
    'method' => 'POST',
    'header' => 'auth_key: dC4h71G518Wwg12wj21R24O3M3IlYKmi',
    'Content-Type' => 'application/json',
    'terminal' => $postdata
),
'ssl'=> array(
     'verify_peer'=>false,
     'verify_peer_name'=>false)
);

$context = stream_context_create($opts);
$result = file_get_contents($url, true, $context);

print_r($result);

header("auth_key: dC4h71G518Wwg12wj21R24O3M3IlYKmi");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Content-Type: application/json");