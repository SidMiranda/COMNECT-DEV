<?php
require_once(getenv('tilevu'));
    require_once($path_class.'GenericDataAccess.php');

    $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
    $userPassword = filter_input(INPUT_POST, 'new-password');
    $userPassword2 = filter_input(INPUT_POST, 're-password');
  
    if($token && $userPassword){
        if($userPassword === $userPassword2){
            
            $hash = password_hash($userPassword, PASSWORD_DEFAULT);
            
            $acDao = new Generic($pdo, 'access_control');
            $userTokenDao = new Generic($pdo, 'users');
            
            $ac = $acDao->findValue($token, 'ac_token');
           
            if($ac && $ac['ac_token'] === $token){
                $userData = ['user_password' => $hash];
                $userCond = ['user_id=' => $ac['user_id']];
                
                if($userTokenDao->update($userData, $userCond)){
                    
                    $newToken = md5(time().rand(0, 9999));
                    
                    $acData = ['ac_token' => $newToken];
                    $acCond = ['user_id=' => $ac['user_id']];
                    
                    if($acDao->update($acData, $acCond)){
                        
                        $_SESSION['userId'] = $ac['user_id'];
                        $_SESSION['clientId'] = $ac['client_id'];
                        $_SESSION['appId'] = $ac['app_id'];
                        $_SESSION['acToken'] = $newToken;
                        $_SESSION['acLevel'] = $ac['ac_level'];
                    }
                    
                    echo "<script>
                            alert('Senha redefinida com sucesso!')
                            location.href = '$url_admin'
                        </script>";
                    
                    exit;
                }
            }
        } 
    }
    
    echo "<script>
            alert('Não foi possivel redefinir a senha!')
            location.href = '$url_auth20'
        </script>";

    exit;

?>