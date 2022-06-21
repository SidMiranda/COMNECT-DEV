<?php

$url = 'https://bluesw2.comnect.com.br:5011';

//curl --cacert ca.crt --cert client.crt:Telecom01 --key client.key -k --data 'data=$postdata

$headers = array(
    "auth_key: dC4h71G518Wwg12wj21R24O3M3IlYKmi",
    "Content-Type: application/json"
);

$postdata = array(
        "m"=>"get_settings",
        "u"=>"13645",
        "v_stt"=>""
    );

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
//curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

//curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($curl, CURLOPT_CAINFO, getcwd().'/bluesw/ca.crt');
//curl_setopt($curl, CURLOPT_CAINFO, getcwd().'/bluesw/client.crt');
curl_setopt($curl, CURLOPT_SSLCERT, getcwd().'/bluesw/client.crt');
curl_setopt($curl, CURLOPT_SSLCERTTYPE, "crt");
curl_setopt($curl, CURLOPT_SSH_PRIVATE_KEYFILE, getcwd().'/bluesw/client.key');
curl_setopt($curl, CURLOPT_SSLCERTPASSWD, 'Telecom01');
curl_setopt($curl, CURLOPT_KEYPASSWD, "Telecom01");

$resp = curl_exec($curl);
curl_close($curl);

print_r(getcwd().'/bluesw/ca.crt<br>');
print_r(getcwd().'/bluesw/client.key');

print_r(json_decode($resp));

exit;

