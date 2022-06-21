<?php
require('config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']); 

if($method === 'post'){

    $numero = filter_input(INPUT_POST, 'numero');
    $valor = filter_input(INPUT_POST, 'valor');
    $pagamento = filter_input(INPUT_POST, 'pagamento');
    $status = filter_input(INPUT_POST, 'status');
    $data = filter_input(INPUT_POST, 'data');
    $pdv = filter_input(INPUT_POST, 'pdv') ?? 0;
    $controle = filter_input(INPUT_POST, 'controle') ?? 0;

    if($numero && $valor && $pagamento && $status && $data){

        $sql = $pdo->prepare("INSERT INTO pedidos (numero, valor, pagamento, status, data, pdv, controle) VALUES 
                                                    (:numero, :valor, :pagamento, :status, :data, :pdv, :controle)");

        $sql->bindValue(':numero', $numero);
        $sql->bindValue(':valor', $valor);
        $sql->bindValue(':pagamento', $pagamento);
        $sql->bindValue(':status', $status);
        $sql->bindValue(':data', $data);
        $sql->bindValue(':pdv', $pdv);
        $sql->bindValue(':controle', $controle);
        $sql->execute();

        $id = $pdo->lastInsertId();

        $array['result'] = [
            'id' => $id,
            'numero' => $numero,
            'valor' => $valor,
            'pagamento' => $pagamento,
            'status' => $status,
            'data' => $data,
            'pdv' => $pdv,
            'controle' => $controle
        ];

    }else{
        $array['error'] = 'Existem campos não enviados';
    }


}else{
    $array['error'] = 'Método não permitido (apenas POST)';
}

include('return.php');