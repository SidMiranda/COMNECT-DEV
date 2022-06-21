<?php 
require_once(getenv('tilevu'));

//mapeia classe Google Recaptcha
include_once("recaptcha.php");
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
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Esqueceu a senha?</h1>
                                        <p class="mb-4">Essas coisas acontecem. Apenas entre com seu email abaixo, e te 
                                            enviaremos um link para resetar sua senha!</p>
                                    </div>
                                    <form id="login-form" class="user" autocomplete="on" method="POST" action="<?=$url_auth20?>actions/recovery-action.php">
                                       <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Endereço de email..." name="userEmail" required>
                                        </div>
                                        
                                        <button class="g-recaptcha btn btn-primary btn-user btn-block" 
                                            data-sitekey="6LdZ3SwdAAAAAPx6SJfrBdjcrrPw_nLMIYWRqsPH" 
                                            data-callback='onSubmit' 
                                            data-action='submit'>Resetar Senha
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?=$url_auth20?>register.php">Criar conta!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?=$url_auth20?>index.php">Já tem uma conta? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
        <script>
           function onSubmit(token) {
             document.getElementById("login-form").submit();
           }
        </script>
    
    
</body>
</html>