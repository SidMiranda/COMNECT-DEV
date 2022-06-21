<?php
    header('Content-Type: text/html; charset=UTF-8');
    
    require_once(getenv('tilevu'));
    require_once($path_class.'GenericDataAccess.php');
        
    $email = filter_input(INPUT_POST, 'userEmail', FILTER_VALIDATE_EMAIL);
    
    if($email){
        $userDao = new Generic($pdo, 'users');
        $user = $userDao->findValue($email, 'user_email');
        if(!$user){
            echo "<script>alert('Verifique o TOKEN na sua caixa de correio.'); location.href = '$url_recovery_token20'</script>";
            logging(" Tentativa restauração de senha. ".$email." INVALIDO");
            exit;
        }
    }

    $token = rand(1001, 9998);
    
    $acDao = new Generic($pdo, 'access_control');
    $acData = ['ac_token' => $token];
    $acCond = ['user_id=' => $user['user_id']];
    $ac = $acDao->update($acData, $acCond);
        
    $body = '<h3>TILEVU</h3>'.
            'Ola, '.$user['user_first_name'].',<br><br>'.
            'Utilize o seguinte codigo para verificar seu email e resetar sua senha.<br>'.
            '<h1>'.$token.'</h1>'.
            'Com os melhores cumprimentos,<br>'.
            'Equipe do Tilevu<br>'.
            '<a href="https://tilevu.com.br">www.tilevu.com.br</a><br>';
    
    $data = [
        'title' => 'TILEVU New Pass',
        'subject' => 'Reset de senha!',
        'sendTo' => $email,
        'redirectUrl' => ''
    ];
    
    $localUse = true;
    include_once($path_mail.'send-mail-generic.php');

    logging(" Tentativa restauração de senha. ".$email);
    echo "<script>alert('Um email foi enviado para $email'); location.href = '$url_recovery_token20'</script>";
       
?>