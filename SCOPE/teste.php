<?php
// BINANCE PRICE
$urlBN = "https://api.binance.com/api/v3/ticker/price?symbol=BTCBRL";

// MERCADO BITCOIN PRICE
$urlMB = "https://www.mercadobitcoin.net/api/BTC/ticker/";

$resultBN = file_get_contents($urlBN);
$resultMB = file_get_contents($urlMB);

$priceBN = json_decode($resultBN)->{'price'};

$ticker = json_decode($resultMB)->{'ticker'};
$priceMB = $ticker->{'buy'};

$dif = $priceBN - $priceMB;

echo "<h2>Binance price</h2>";
echo "R$ ".$priceBN;
echo "<hr>";
echo "<h2>Mercado Bitcoin price:</h2>";
echo "R$ ".$priceMB;
echo "<hr>";
echo "<h2>Diferença em reais:</h2>";
echo "R$ ".($dif * 1);

exit;


// retorno token mercado bitcoin
/*{
  "access_token": "AAAAAAAAAAAAAAAAAAAAAFnz2wAAAAAACOwLSPtVT5gxxxxxxxxxxxx",
  "expiration": 1634220858
}*/

// TOKEN ACESSO TEM 3 HORAS DE VALIDADE
//stdClass Object ( [access_token] => 01FYES4V62WXK49PHXB1W2YWQM [expiration] => 1648220893 )

//segredo da API -> 14e07ffe9e89cc4a33e5aeed35f00d907b92789b8411b5f6541343a51a9ea98a
// ID:f42ee844f82a32706b0b80576eade5c1, somente leitura

//$url = "https://api.mercadobitcoin.net/api/v4/authorize";

/*$postdata2 = http_build_query(
    array(
        'login' => 'f42ee844f82a32706b0b80576eade5c1',
        'password' => '14e07ffe9e89cc4a33e5aeed35f00d907b92789b8411b5f6541343a51a9ea98a'
    )
);

$opts = array('http' =>
    array(
        'method' => 'POST',
        'header' => 'Content-type: application/x-www-form-urlencoded',
        //'header' => 'Content-type: multipart/form-data',
        'content' => $postdata2
    )
);
$context = stream_context_create($opts);
$result = file_get_contents($url, false, $context);*/

