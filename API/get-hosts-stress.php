<?php
require('config-stress.php');


$method = strtolower($_SERVER['REQUEST_METHOD']); 

$ip = '192.168.20.1'; //$_GET['ip'];

if($method === 'post'){

    $sql = $pdo->prepare("SELECT * FROM hosts WHERE ip = :ip");
    $sql->bindValue(':ip', $ip);
    $sql->execute();

    if($sql->rowCount() > 0){
        $data = $sql->fetch(PDO::FETCH_ASSOC);

        echo json_encode($data);

    }else{
        echo "Dispositivo não configurado!";
    }

}else{
    $array['error'] = 'Método não permitido (apenas POST)';
}

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Content-Type: application/json");

exit;