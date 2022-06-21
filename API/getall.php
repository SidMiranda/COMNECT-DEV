<?php
require('config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']); 

if($method === 'get'){

    $sql = $pdo->query("SELECT * FROM pedidos");
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