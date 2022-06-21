<?php

//auth_key_rest_api=dC4h71G518Wwg12wj21R24O3M3IlYKmi

$ip = $_GET["ip"];
$req = $_GET["req"];

$url = "https://192.168.20.197:8085/scope/rest/info";
$token = "dC4h71G518Wwg12wj21R24O3M3IlYKmi";

$optsT = array('http' => array(
    'method' => 'GET',
    'header' => 'auth_key: dC4h71G518Wwg12wj21R24O3M3IlYKmi'
),
'ssl'=> array(
     'verify_peer'=>false,
     'verify_peer_name'=>false)
);

$contextT = stream_context_create($optsT);
$resultT = file_get_contents($url, true, $contextT);

print_r($resultT);

header("auth_key: dC4h71G518Wwg12wj21R24O3M3IlYKmi");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Content-Type: application/json");
