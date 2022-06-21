<?php
require('config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']); 

if($method === 'put'){

    parse_str(file_get_contents('php://input'), $input);
   
    $numero = $input['numero'] ?? null;
    $status = $input['status'] ?? null;
    $controle = $input['controle'] ?? 0;

    $numero = filter_var($numero);
    $status = filter_var($status);

    if($numero && $status){
        $sql = $pdo->prepare("SELECT * FROM pedidos WHERE numero = :numero");
        $sql->bindValue(':numero', $numero);
        $sql->execute();

        if($sql->rowCount() > 0 ){

            $sql = $pdo->prepare("UPDATE pedidos SET status = :status, controle = :controle WHERE numero = :numero");
            $sql->bindValue(':status', $status);
            $sql->bindValue(':controle', $controle);
            $sql->bindValue(':numero', $numero);
            $sql->execute();

            $array['result'] = [
                'numero' => $numero,
                'status' => $status,
                'controle' => $controle
            ];

        }else{
            $array['error'] = 'Pedido inexistente';
        }
    }else{
        $array['error'] = "Dados não enviados" . $numero . "|" . $status;
    }

}else{
    $array['error'] = 'Método não permitido (apenas PUT)';
}

include('return.php');