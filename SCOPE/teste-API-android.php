<?php
require('../API/config.php');

$url = "http://update2.comnect.com.br:5022";

$arr1 = "{'m':'get_settings','u':'14013'}";
$arr2 = '{"m":"get_settings","u":"14013"}';

//data=%7B%22m%22%3A%22get_settings%22%2C%22u%22%3A%2214013%22%7D 

$postdata = http_build_query(
    array(
        'data' => '{"m":"get_settings","u":"14013"}'
    )
);

$opts = array('http' => array(
    'method' => 'POST',
    'header' => 'Content-type: application/x-www-form-urlencoded',
    'data' => $arr2,
    'content' => $postdata),
'ssl'=> array(
     'verify_peer'=>false,
     'verify_peer_name'=>false)
);

$context = stream_context_create($opts);
$result = file_get_contents($url, false, $context);

print_r($result);

header("Content-Type: application/json");


exit;

/*
Endpoint
http://update2.comnect.com.br:5022
postar o json como string no parâmetro “data”
get_settings
request
{"m":"get_settings","u":"14013"}
*/
