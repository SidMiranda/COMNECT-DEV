<?php

$url = "http://update2.comnect.com.br:5022";
$json = 'data:{"m":"get_settings","u":"14013"}';

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_PORT => "5022",
  CURLOPT_URL =>  "http://update2.comnect.com.br:5022/",
  CURLOPT_RETURNTRANSFER => true,
  //CURLOPT_ENCODING => "",
  //CURLOPT_MAXREDIRS => 10,
  //CURLOPT_TIMEOUT => 30,
  //CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_SSL_VERIFYHOST => false,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "data=%7B%22m%22%3A%22get_settings%22%2C%22u%22%3A%2214013%22%7D",
  //CURLOPT_POSTFIELDS => 'data={"m":"get_settings","u":"14013"}',
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/x-www-form-urlencoded"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

/*
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$resp = curl_exec($curl);
curl_close($curl);
print_r(json_decode($resp));
*/
