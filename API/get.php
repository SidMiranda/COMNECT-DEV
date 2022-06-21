<?php
require('config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']); 

if($method === 'get'){

    $numero = filter_input(INPUT_GET, 'numero');
    if($numero){
        $sql = $pdo->prepare("SELECT * FROM pedidos WHERE numero = :numero");
        $sql->bindValue(':numero', $numero);
        $sql->execute();

        if($sql->rowCount() > 0){
            $data = $sql->fetch(PDO::FETCH_ASSOC);

            $array['result'][] = [
                'Numero'=> $data['numero'],
                'Valor'=>$data['valor'],
                'Forma de Pagamento'=>$data['pagamento'],
                'Status'=>$data['status'],
                'Data'=>$data['data']
            ];

        }else{
            $array['error'] = 'Numero não encontrado';
        }
    }else{
        $array['error'] = 'Numero não enviado';
    }
}else{
    $array['error'] = 'Método não permitido (apenas GET)';
}

include('return.php');