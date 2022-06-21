<?php
    session_start();

    /*AUTENTICAÇÃO*/
    $emailAuth = 'desenvcluster@comnect.com.br';
    $wspassword = '123mudar';

    /*DADOS REVENDA*/
    $cnpj = $_GET['cnpj']; //cnpj(0);
    $razao = $_GET['razao'];
    $fantasia = $_GET['razao'];
    //$inscestadual = '';
    $responsavel = $_GET['nome'];
    //$cpfeesponsavel = '';
    //$grpempresarial = 'matriz';
    //$cnpjmatriz = '';
    $contato = $_GET['nome'];
    //$logradouro = ''; $numero = ''; $bairro = '';
    //$complemento = ''; $uf = ''; $cidade = ''; $cep = '';
    $ddd = substr($_GET['telefone'], 2); 
    $telefone = substr($_GET['telefone'], -9);
    //$ddd2 = ''; $telefone2 = '';
    $email= $_GET['email'];

    //$hash = password_hash($senha, PASSWORD_DEFAULT);

try{ 
    $url = "http://portal2.comnect.com.br/webservice2/wsdl";

    $soapclient = new SoapClient($url);
    $credenciais = array('email'=>$emailAuth, 'wspassword'=>$wspassword);

    $dadosrevenda = array(
        'cnpj'=>$cnpj, 
        'razao'=>$razao, 
        'fantasia'=>$fantasia, 
        'responsavel'=>$responsavel, 
        'contato'=>$contato, 
        'telefone'=>$telefone, 
        'email'=>$email);
        
    $dadosusuario = array(
        'nome'=>$contato, 
        'email'=>$email, 
        'usuario'=>$email, 
        'senha'=>'123mudar');

    $cnpjrevenda = array('cnpjrevenda'=>$cnpj);

    $responseRev = $soapclient->addrevenda($credenciais, $dadosrevenda);

    if($responseRev['retorno']){
        $responseUsr = $soapclient->addusuariorevenda($credenciais, $dadosusuario, $cnpj);
        if($responseUsr['retorno']){
            echo $responseUsr['mensagem'];
        }else{
            echo $responseUsr['mensagem'];
        }
    }else{
        echo $responseRev['mensagem'];
    }

    exit; 
}catch(Exception $e){
    echo $e->getMessage();
}

function mod($dividendo,$divisor)
{
   return round($dividendo - (floor($dividendo/$divisor)*$divisor));
}


function cnpj($compontos)
{
   $n1 = rand(0,9);
   $n2 = rand(0,9);
   $n3 = rand(0,9);
   $n4 = rand(0,9);
   $n5 = rand(0,9);
   $n6 = rand(0,9);
   $n7 = rand(0,9);
   $n8 = rand(0,9);
   $n9 = 0;
   $n10= 0;
   $n11= 0;
   $n12= 1;
   $d1 = $n12*2+$n11*3+$n10*4+$n9*5+$n8*6+$n7*7+$n6*8+$n5*9+$n4*2+$n3*3+$n2*4+$n1*5;
   $d1 = 11 - ( mod($d1,11) );

   if ( $d1 >= 10 )
   { 
      $d1 = 0 ;
   }
   $d2 = $d1*2+$n12*3+$n11*4+$n10*5+$n9*6+$n8*7+$n7*8+$n6*9+$n5*2+$n4*3+$n3*4+$n2*5+$n1*6;
   $d2 = 11 - ( mod($d2,11) );

   if ($d2>=10) { $d2 = 0 ;}

   $retorno = '';

   if ($compontos==1) {$retorno = ''.$n1.$n2.".".$n3.$n4.$n5.".".$n6.$n7.$n8."/".$n9.$n10.$n11.$n12."-".$d1.$d2;}
   else {$retorno = ''.$n1.$n2.$n3.$n4.$n5.$n6.$n7.$n8.$n9.$n10.$n11.$n12.$d1.$d2;}

   return $retorno;
}
      
     /*                   
    $body = "<div style='max-width:500px;'>" .
    "<div style='background-color:#33BCD0; font-size:1.4em; color:white; padding:20px; font-weight:700; text-align:center; '>Seja bem Vindo!</div>" .
    "<div style='font-size:20px; color:#555555; font-family: Roboto, sans-serif; padding:20px;'>" .
    $userFirstName.",<br><br>" .
    "Ficamos felizes em ter você como nosso parceiro. <br>" .
    "Siga-nos nas redes sociais e aproveite ao maximo nossa plataforma de homologação.<br>" .
    "<hr><strong>" .
    
    "Fique a vontade para entrar em contato, tirar dúvidas e dar sugestões... <br>" .
    "</strong><hr>" .
    
    "<br>" .
    "Facebook" .
    "</span>" .
    "<br>Youtube" .
    "<br>Instagram" .
    
    "</div><div style='background-color:#33BCD0; font-size:1.3em; color:white; padding:10px; font-weight:600; text-align:center; '>Equipe Comnect</div></div>";
                        
    $data = [
        'title' => 'COMNECT New Account',
        'subject' => 'Bem Vindo!',
        'sendTo' => $userEmail,
        'redirectUrl' => ''
    ];                        
                    
    $localUse = true;
    include_once($path_mail.'send-mail-generic.php');
    
    logging("Nova conta criada com sucesso! --> ".$userEmail);

    echo "<script>
            alert('Conta criada com sucesso!')
            location.href = '$url_admin'
            </script>";
    
                  

*/
    ?>