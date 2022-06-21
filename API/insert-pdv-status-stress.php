<?php
require('config-stress.php');


$method = strtolower($_SERVER['REQUEST_METHOD']); 

if($method === 'post'){

    $pdv = filter_input(INPUT_POST, 'pdv');
    $status = filter_input(INPUT_POST, 'status') ?? 0;

    if($pdv){
        $q = $pdo->prepare("SELECT * FROM pdv WHERE pdv = :pdv");
        $q->bindValue(':pdv', $pdv);
        $q->execute();

        if($q->rowCount() > 0){
            $sql = $pdo->prepare("UPDATE pdv SET status = :status WHERE pdv = :pdv");
            $sql->bindValue(':status', $status);
            $sql->bindValue(':pdv', $pdv);
            $sql->execute();
        }else{
            $sql = $pdo->prepare("INSERT INTO pdv (pdv, status) VALUES (:pdv, :status)");

            $sql->bindValue(':pdv', $pdv);
            $sql->bindValue(':status', $status);
            $sql->execute();
            
        }

        $id = $pdo->lastInsertId();

        $array['result'] = [
            'id' => $id,
            'pdv' => $status,
            'pdv' => $status
        ];

    }else{
        $array['error'] = 'Existem campos não enviados';
    }


}else{
    $array['error'] = 'Método não permitido (apenas POST)';
}

include('return.php');