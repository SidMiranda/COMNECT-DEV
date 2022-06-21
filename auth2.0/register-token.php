<?php 
require_once(getenv('tilevu'));

$userFirstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_SPECIAL_CHARS);
$userLastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_SPECIAL_CHARS);
$userFullName = $userFirstName.' '.$userLastName;
$userEmail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$userPassword = filter_input(INPUT_POST, 'password');
$userPassword2 = filter_input(INPUT_POST, 're-password');

if($userFirstName && $userEmail && $userPassword){
    if($userPassword === $userPassword2){
        $token = rand(1001, 9998);
        $_SESSION['register-token'] = $token;
        
        $body = '<h3>TILEVU</h3>'.
            'Ola, '.$userFirstName.',<br><br>'.
            'Utilize o seguinte token para verificar seu email!<br>'.
            '<h1>'.$token.'</h1>'.
            'Com os melhores cumprimentos,<br>'.
            'Equipe do Tilevu<br>'.
            '<a href="https://tilevu.com.br">www.tilevu.com.br</a><br>';
        
        $data = [
            'title' => 'TILEVU new account',
            'subject' => 'Verificar Email!',
            'sendTo' => $userEmail,
            'redirectUrl' => ''
        ];
        
        $localUse = true;
        include_once($path_mail.'send-mail-generic.php');
        
        logging(" Tentativa registro de conta. ".$userEmail);
        
    }else{
        echo "<script>
            alert('Password does not match!')
            location.href = '$url_register20'
        </script>";
        exit;
    }
}else{
    echo "<script>
            alert('Corrija os campos e tente novamente!')
            location.href = '$url_register20'
        </script>";
    exit;
}

?>
<head><?php require_once('head.php'); ?></head>
<body>
	
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center">
                            
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Verifique seu email</h1>
                                        <p class="mb-4">Enviamos um email com um TOKEN para 
                                        	<i style="color:#00FF45"><?= $userEmail ?></i></p>
                                    </div>
                                    <form class="user" autocomplete="on" method="POST" action="<?=$url_auth20?>actions/register-action.php">  
                                        <input type="text" name="firstName" value="<?=$userFirstName ?>" hidden >
                                    	<input type="text" name="lastName" value="<?=$userLastName ?>" hidden >
                                    	<input type="text" name="email" value="<?=$userEmail ?>" hidden >
                                    	<input type="text" name="password" value="<?=$userPassword ?>" hidden >
                                    	<input type="text" name="re-password" value="<?=$userPassword2 ?>" hidden >
                                        <div class="form-group">
                                            <input type="number" class="form-control form-control-user"
                                                placeholder="TOKEN" name="token">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Verificar Email
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="index.php">Ir para o login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>