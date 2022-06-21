<?php

$url = 'https://192.168.20.197:8085/scope/rest/terminal/?online=online';

//?codEmpresa="0001"&codLoja="0001&codTermianl="030"&codPerfilHardware="003"&codPerfilServico="236"';

/*curl --location --request POST '' \

--data-urlencode 'codEmpresa="0001"' \
--data-urlencode 'codLoja="0001"' \
--data-urlencode 'codTerminal="030"' \
--data-urlencode 'codPerfilHardware="003"' \
--data-urlencode 'codPerfilServico="236"'*/

$headers = array(
    "auth_key: dC4h71G518Wwg12wj21R24O3M3IlYKmi",
    "Content-Type: application/json"
);

$postdata = array('codEmpresa' => '0001',
            'codLoja' => '0001',
            'codTerminal' => '031',
            'codPerfilHardware' => '003',
            'codPerfilServico' => '236'
    );

//$url = "https://192.168.20.197:8085/scope/rest/info";
//$token = "dC4h71G518Wwg12wj21R24O3M3IlYKmi";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

/*$headers = array(
    "auth_key: dC4h71G518Wwg12wj21R24O3M3IlYKmi",
    "Accept:application/json"
);*/

curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$resp = curl_exec($curl);
curl_close($curl);
print_r(json_decode($resp));

exit;

