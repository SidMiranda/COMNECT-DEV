<?php
require('../API/config.php');

$url = "https://transaction2.comnect.com.br:5021";
$user = "batman@dccomics.com";
$pass = "123mudar";

function getCardNumber(){
    return $_GET['cardNumber'] ?? 0;
}

$method = strtolower($_SERVER['REQUEST_METHOD']);

if($method === 'get'){

    $data = json_decode(getTransaction($url, getToken($url, $user, $pass)), true);

    $count = 0;
    
    foreach($data as $item){
        if($item['situacao_detalhe'] == 'OK'){
            //print_r($item['situacao_detalhe']);exit;
            if($count < 6){
                $array['result'][] = [
                    'Numero'=> $item['data_mensagem'],
                    'Valor'=>$item['valor'],
                    'Forma de Pagamento'=>$item['cod_pdv'],
                    'Controle'=>$item['cod_controle'],
                    'Situacao'=>$item['situacao_detalhe']
                ];
            }$count++;
        }
        
    }

}else{
    $array['error'] = 'Método não permitido (apenas GET)';
}

function getToken($url, $user, $pass){
    $postdata = http_build_query(
        array(
            'metodo' => 'get_token',
            'usuario' => $user,
            'senha' => $pass
        )
    );
    $opts = array('http' => array(
                            'method' => 'POST',
                            'header' => 'Content-type: application/x-www-form-urlencoded',
                            'content' => $postdata),
                  'ssl'=> array(
                             'verify_peer'=>false,
                             'verify_peer_name'=>false)
                  );
    
    $context = stream_context_create($opts);
    $result = file_get_contents($url, false, $context);
    
    //print_r(json_decode($result));
    $token_acesso = json_decode($result)->{'token_acesso'};

    return $token_acesso;
}

function getTransaction($url, $token_acesso){

    if(getCardNumber() != 0){
        $transacoes = http_build_query(
            array(
                'metodo' => 'get_transacoes',
                'token_acesso' => $token_acesso,
                'numero_cartao'=> getCardNumber()
            )    
        );
    }else{
        $transacoes = http_build_query(
            array(
                'metodo' => 'get_transacoes',
                'token_acesso' => $token_acesso
            )    
        );
    }
    
    $optsT = array('http' => array(
        'method' => 'POST',
        'header' => 'Content-type: application/x-www-form-urlencoded',
        'content' => $transacoes),
    'ssl'=> array(
         'verify_peer'=>false,
         'verify_peer_name'=>false)
    );
    
    $contextT = stream_context_create($optsT);
    $resultT = file_get_contents($url, false, $contextT);
    
    return $resultT;
}

include('../API/return.php');

