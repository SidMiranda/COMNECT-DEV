<?php
//mapeia arquivo de configuração na raiz do projeto (config.php)
require_once(getenv('tilevu'));

//mapeia classes genericas de acesso a dados
require_once($path_class.'GenericDataAccess.php');

    //recebe e valida campos de email e senha
    //$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    //$password = filter_input(INPUT_POST, 'password'); 
    
    $email = $_GET['user'] ?? '';
    $pass = $_GET['pass'] ?? '';

    //checa se os campos email e senha estão preenchidos
    if($email && $password){
        //carrega a tabela de usuarios
        $userDao = new Generic($pdo, 'users');
        
        //verifica se existe o email digitado na tabela de usuarios
        $user = $userDao->findValue($email, 'user_email');
        
        if($user){
            //se o usuario existe, verifica se a senha corresponde com a digitada
            if(password_verify($password, $user['user_password'])){
                //carrega a tabela controle de acesso
                $acDao = new Generic($pdo, 'access_control');
                
                //verifica se o usuaio existe na tabela controle de acesso
                $accessControl = $acDao->findValue($user['user_id'], 'user_id');
                if($accessControl){
                    //se o usuaio existir atualiza o token
                    if($accessControl['ac_token'] == ''){
                        $acToken = md5(time().rand(0, 9999));
                    }else{
                        $acToken = $accessControl['ac_token'];
                    }
                    $accessControl['ac_token'] = $acToken;
                    $cond = array('user_id=' => $user['user_id']);
                    
                    //atualiza a tabela controle de acesso com o novo token e seta os dados da sessão
                    if($acDao->update($accessControl, $cond)){
                        $_SESSION['userId'] = $accessControl['user_id'];
                        $_SESSION['clientId'] = $accessControl['client_id'];
                        $_SESSION['appId'] = $accessControl['app_id'];
                        $_SESSION['appUrl'] = $accessControl['app_url'];
                        $_SESSION['acToken'] = $acToken;
                        $_SESSION['acLevel'] = $accessControl['ac_level'];
                        
                        //registra o login no arquivo log.txt
                        logging(" Login ".$accessControl["app_url"]." ".$email);
                        
                        //direciona para pagina inicial do painel admin
                        header("Location: ".$url_admin.'index.php');
                        exit;
                    }                    
                }
            }
        }
    }
    
    /*se alguma condição não for verdadeira, retorna a mensagem usuario ou senha invalida
    echo "<script>alert('Usuário ou senha inválida!')
                  location.href = '".$url_auth20."index.php'
          </script>";*/
    exit;

?>