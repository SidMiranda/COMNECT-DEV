<?php
/*CREDENCIAIS*/
$login = 'desenvcluster@comnect.com.br';
$senha = '123mudar';

/*DADOS REVENDA*/
$razao = $_POST['razao'];
$fantasia = $_POST['fantasia'];
$email = $_POST['email'];
$cnpj = $_POST['cnpj'];
$responsavel = $_POST['responsavel'];

try{
    $url = 'http://portal2.comnect.com.br/webservice2/wsdl';

    $soapclient = new SoapClient($url);
    $credenciais = array('email'=>$login, 'wspassword'=>$senha);

    $dadosrevenda = array(
        'razao'=>$razao,
        'fantasia'=>$fantasia,
        'email'=>$email,
        'cnpj'=>$cnpj,
        'responsavel'=>$responsavel
    );

    $response = $soapclient->addrevenda($credenciais, $dadosrevenda);

    print_r($response);

}catch(Exception $e){
    echo $e->getMessage();
}