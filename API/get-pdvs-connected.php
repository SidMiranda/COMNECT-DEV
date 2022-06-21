<?php
require('config-stress.php');


$method = strtolower($_SERVER['REQUEST_METHOD']); 

if($method === 'post'){

    $sql = $pdo->prepare("SELECT COUNT(id) as pdvs FROM pdv WHERE status = 1");
    $sql->execute();

    if($sql->rowCount() > 0){
        $data = $sql->fetch(PDO::FETCH_ASSOC);

        $pdvs = $data['pdvs'];

    }else{
        $pdvs = 'Nenhum PDV online';
    }

}else{
    $array['error'] = 'Método não permitido (apenas POST)';
}

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Content-Type: application/json");

echo $pdvs;
exit;