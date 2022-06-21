<?php
    session_start();

    
    $wsemail = $_GET['wsemail'] ?? '';
    $wspassword = $_GET['wspassword'] ?? '';

try{ 
    //$url = "http://portal2.comnect.com.br/webservice2/wsdl";
    //$url = "http://201.6.152.59/webservice2/wsdl";
    $url = "http://192.168.20.108:3000/webservice2/wsdl";

    //echo "<script type='text/javascript'>console.log(".$url.")</script>";

    $soapclient = new SoapClient($url);
    $param=array('email'=>$wsemail, 'wspassword'=>$wspassword);
    $response = $soapclient->geratokenacesso($param);
    $array = json_decode(json_encode($response), true);

    $_SESSION['wsemail'] = $array['user_name'];
    $_SESSION['wspassword'] = $wspassword;
    $_SESSION['token'] = $array['token_acesso'];

    logging(' LOGIN '.$wsemail);
            
    echo json_encode($array);
    exit; 
}catch(Exception $e){
    echo $e->getMessage();
}

function logging($log){
    $file = fopen("/var/www/COMNECT-DEV/log.txt", "a");
    fwrite($file, date('d/m/Y H:i')."$log\n");
    fclose($file);
}

?>