<?php
require('config.php');


$method = strtolower($_SERVER['REQUEST_METHOD']); 

if($method === 'put'){

    parse_str(file_get_contents('php://input'), $input);
   
    $id = $input['id'] ?? null;
    $valor = $input['numero'] ?? null;
    $pagamento = $input['numero'] ?? null;

    $id = filter_var($id);
    $valor = filter_var($valor);
    $pagamento = filter_var($pagamento);

    if($id && $valor && $pagamento){
        $sql = $pdo->prepare("SELECT * FROM pedidos WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if($sql->rowCount() > 0 ){

            $sql = $pdo->prepare("UPDATE pedidos SET valor = :valor, pagamento = :pagamento WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->bindValue('valor', $valor);
            $sql->bindValue('pagamento', $pagamento);
            $sql->execute();

            $array['result'] = [
                'id' => $id,
                'valor' => $valor,
                'pagamento' => $pagamento
            ];

        }else{
            $array['error'] = 'ID inexistente';
        }
    }else{
        $array['error'] = "Dados não enviados";
    }

}else{
    $array['error'] = 'Método não permitido (apenas PUT)';
}

include('return.php');