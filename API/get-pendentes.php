<?php
require('config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']); 

if($method === 'get'){

    $pdv = filter_input(INPUT_GET, 'pdv') ?? 0;

    if($pdv > 0){
        $sql = $pdo->prepare("SELECT * FROM pedidos WHERE status = :status AND pdv = :pdv");
        $sql->bindValue(':pdv', $pdv);
    }else{
        $sql = $pdo->prepare("SELECT * FROM pedidos WHERE status = :status");
    }

    $sql->bindValue(':status', 'pendente');
    $sql->execute();

    if($sql->rowCount() > 0){
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach($data as $item){
            $array['result'][] = [
                'Numero'=> $item['numero'],
                'Valor'=>$item['valor'],
                'Forma de Pagamento'=>$item['pagamento'],
                'Status'=>$item['status'],
                'Data'=>$item['data']
            ];
        }
    }

}else{
    $array['error'] = 'Método não permitido (apenas GET)';
}

include('return.php');