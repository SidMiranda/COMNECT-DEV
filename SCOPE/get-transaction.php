<?php
//header('Content-Type: application/json');

$data = [
    'metodo' => 'get_token',
    'usuario' => 'batman@dccomics.com',
    'senha' => '123mudar'
];

$postdata = http_build_query($data);
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://transaction2.comnect.com.br:5021");
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
echo $response;

// URL TESTE -> https://transaction2.comnect.com.br:5021/test

//https://www.delftstack.com/pt/howto/php/php-post-request/#:~:text=Use%20o%20m%C3%A9todo%20curl_exec(),tamb%C3%A9m%20usa%20o%20arquivo%20request.

?>

<form method="POST">
    <button type="submit">POST</button>
</form>