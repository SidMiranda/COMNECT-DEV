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
        'redirectUri'  => 'https://tilevu.com.br/auth2.0/actions/google-oauth2-register.php',
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
                
                if($ownerDetails->getId()){
                        
                    $userFirstName = $ownerDetails->getFirstName();
                    $userLastName = $ownerDetails->getLastName();
                    $userFullName = $userFirstName.' '.$userLastName;
                    $userEmail = $ownerDetails->getEmail();
                        
                    if($userFirstName && $userEmail){
                        
                        $userDao = new Generic($pdo, 'users');
                        $clientDao = new Generic($pdo, 'clients');
                        $appDao = new Generic($pdo, 'apps');
                        $acDao = new Generic($pdo, 'access_control');
                                
                        $user = $userDao->findValue($userEmail, 'user_email');
                        
                        if(!$user){
                                    
                            $hash = 'Google Auth';
                                        
                            $userData = [
                                'user_first_name' => $userFirstName,
                                'user_last_name' => $userLastName,
                                'user_email' => $userEmail,
                                'user_password' => $hash
                            ];
                                            
                            $userDao->insert($userData);
                            $userId = $userDao->getLastId('users', 'user_id');
                            
                            $clientData = [
                                'user_id' => $userId,
                                'client_name' => $userFullName,
                                'client_email' => $userEmail
                            ];
                        
                            $clientDao->insert($clientData);
                            $clientId = $clientDao->getLastId('clients', 'client_id');
                            
                            $appData = [
                                'client_id' => $clientId,
                                'app_logo' => "default.png",
                                'app_email' => $userEmail
                                
                            ];
                                            
                            $appDao->insert($appData);
                            $appId = $appDao->getLastId('apps', 'app_id');
                            
                            $acToken = md5(time().rand(0, 9999));
                            $acLevel = 1000;
                            
                            $acData = [
                                'user_id' => $userId,
                                'client_id' => $clientId,
                                'app_id' => $appId,
                                'ac_token' => $acToken,
                                'ac_level' => $acLevel
                            ];
                                
                            if($acDao->insert($acData)){
                                $_SESSION['userId'] = $userId;
                                $_SESSION['clientId'] = $clientId;
                                $_SESSION['appId'] = $appId;
                                $_SESSION['acToken'] = $acToken;
                                $_SESSION['acLevel'] = $acLevel;
                                        
                                $body = "<div style='max-width:500px;'>" .
                                    "<div style='background-color:#33BCD0; font-size:1.4em; color:white; padding:20px; font-weight:700; text-align:center; '>Seja bem Vindo!</div>" .
                                    "<div style='font-size:20px; color:#555555; font-family: Roboto, sans-serif; padding:20px;'>" .
                                    $userFirstName.",<br><br>" .
                                    "Ficamos felizes em ter você como nosso parceiro. <br>" .
                                    "Siga-nos nas redes sociais e aproveite ao maximo nossa plataforma de delivery.<br>" .
                                    "<hr><strong>" .
                                    
                                    "Fique a vontade para entrar em contato, tirar dúvidas e dar sugestões... <br>" .
                                    "</strong><hr>" .
                                    
                                    "<br>" .
                                    "Facebook" .
                                    "</span>" .
                                    "<br>Youtube" .
                                    "<br>Instagram" .
                                    
                                    "</div><div style='background-color:#33BCD0; font-size:1.3em; color:white; padding:10px; font-weight:600; text-align:center; '>Equipe Tilevu</div></div>";
                                    
                                    $data = [
                                        'title' => 'TILEVU New Account',
                                        'subject' => 'Bem Vindo!',
                                        'sendTo' => $userEmail,
                                        'redirectUrl' => ''
                                    ];
                                        
                                    $localUse = true;
                                    include_once($path_mail.'send-mail-generic.php');
                                    
                                    logging(" Nova conta criada com Google Auth! --> ".$userEmail);
                                            
                                    echo "<script>
                                            alert('Conta criada com sucesso!')
                                            location.href = '$url_admin'
                                         </script>";
                                            
                                    exit;
                                    
                                }   
                           
                       }else{
                            echo "<script>
                                    alert('Email já cadastrado!')
                                    location.href = '$url_register20'
                                </script>";
                        exit;
                       }
                    }
              
                }
                        
                echo "<script>
                         alert('Não foi possivel completar o cadastro. Tente novamente!')
                         location.href = '$url_register20'
                     </script>";
                exit;
               
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