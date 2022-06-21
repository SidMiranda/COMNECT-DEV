<?php 
ob_start();
//mapeia arquivo de configuração na raiz do projeto (config.php)
require_once(getenv('tilevu'));

//mapeia classes genericas de acesso a dados
require_once($path_class.'GenericDataAccess.php');

//Load Composer's autoloader
require '/var/www/tilevu/composer/vendor/autoload.php';
use League\OAuth2\Client\Provider\Google;

if (empty($_SESSION['userLogin'])) {
    
    $provider = new Google([
        'clientId'     => '45480678625-r124o514vvp0q9qru7lhkvkfnu4uj49h.apps.googleusercontent.com',
        'clientSecret' => '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',
        //6LcBk2seAAAAABS9SNqgfdAQambc_XxX7DcqxymE
        'redirectUri'  => 'https://tilevu.com.br/auth2.0/actions/google-oauth2-login.php',
    ]);
    
    if (!empty($_GET['error'])) {
        
        // Got an error, probably user denied access
        exit('Got error: ' . htmlspecialchars($_GET['error'], ENT_QUOTES, 'UTF-8'));
        
    } elseif (empty($_GET['code'])) {
        
        // If we don't have an authorization code then get one
        $authUrl = $provider->getAuthorizationUrl();
        $_SESSION['oauth2state'] = $provider->getState();
        header('Location: ' . $authUrl);
        exit;
        
    } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
        
        // State is invalid, possible CSRF attack in progress
        unset($_SESSION['oauth2state']);
        exit('Invalid state');
        
    } else {
        
        // Try to get an access token (using the authorization code grant)
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);
        
        // Optional: Now you have a token you can look up a users profile data
        try {
            
            // We got an access token, let's now get the owner details
            $ownerDetails = $provider->getResourceOwner($token);
            
            // Use these details to create a new profile
            $Guser = [
                'firstName' => $ownerDetails->getFirstName(),
                'lastName' => $ownerDetails->getLastName(),
                'email' => $ownerDetails->getEmail(),
                'id' => $ownerDetails->getId()
            ];
            
            if($Guser){
                //carrega a tabela de usuarios
                $userDao = new Generic($pdo, 'users');
                
                //verifica se existe o email digitado na tabela de usuarios
                $user = $userDao->findValue($ownerDetails->getEmail(), 'user_email');
                
                if($user){
                    //se o usuario existe, verifica se possui id valido
                    if($ownerDetails->getId()){
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
                                logging(" Login Google ".$accessControl["app_url"]." ".$email);
                                
                                //direciona para pagina inicial do painel admin
                                header("Location: ".$url_admin.'index.php');
                                exit;
                            }
                        }
                    }
                }else{
                    echo "<script>
                            alert('Email não cadastrado!')
                            location.href = '$url_register20'
                        </script>";
                    exit;
                }
            }
            
        } catch (Exception $e) {
            
            // Failed to get user details
            exit('Something went wrong: ' . $e->getMessage());
            
        }
        
        // Use this to interact with an API on the users behalf
        echo $token->getToken();
        
        // Use this to get a new access token if the old one expires
        echo $token->getRefreshToken();
        
        // Unix timestamp at which the access token expires
        echo $token->getExpires();
    }
    
} else {
    echo "<h1>User</h1>";
    var_dump($_SESSION['userLogin']);
}

ob_end_flush();
?>