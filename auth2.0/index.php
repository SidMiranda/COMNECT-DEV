<?php require_once("/var/www/COMNECT-DEV/config.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0//EN">
<html>
<head><?php require_once('head.php'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">          
            <div class="col-xl-5 col-lg-5 col-md-6">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">COMNECT LUPA</h1>
                            </div>
                            <form class="user" id="login-form" autocomplete="on">
                            <div class="form-group">
                                    <input id="email" type="text" class="form-control form-control-user" required
                                        placeholder="Digite seu email..." >
                                </div>
                                <div class="form-group">
                                    <input id="wspassword" type="password" class="form-control form-control-user" required
                                        placeholder="Senha">
                                </div>
                                
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" name="logged" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Manter logado</label>
                                    </div>
                                </div>
                                
                                <div class="g-recaptcha btn btn-primary btn-user btn-block" onclick="submit()">Login</div>
                                <hr>
                                <a href="actions/google-oauth2-login.php" class="btn btn-google btn-user btn-block" hidden>
                                    <i class="fab fa-google fa-fw"></i> Login com Google
                                </a>
                                
                            </form>
                            <hr>
                            <div class="text-center" hidden>
                                <a class="small" href="recovery.php">Esqueseu a senha?</a>
                            </div>
                            <div class="text-center" >Não tem cadastro? 
                                <a class="small" href="register.php">Registrar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <script>
        function submit(){
            let wsemail = document.getElementById('email').value
            let wspassword = document.getElementById('wspassword').value

            $.get('actions/login-action.php', {wsemail:wsemail, wspassword:wspassword}, function(response){
              response = JSON.parse(response)

              if(response['retorno'] == 'true'){
                  location.href = '../app/index.php'
              }else{
                  alert(response['mensagem'])
                  location.reload()
              }
          })
        }
    </script>

</body>
</html>