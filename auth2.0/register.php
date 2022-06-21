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
                                <h1 class="h3 text-gray-900 mb-4">Criar Conta</h1>
                                <h5 class="text-gray-900">Desenvolvedor Comnect</h5><br>
                            </div>
                            <form class="user" id="register-form" autocomplete="on">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="inputNome"
                                        placeholder="Nome completo">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" id="inputEmail"
                                        placeholder="Email comercial">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control"
                                            id="inputPassword" placeholder="Senha">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control "
                                            id="repeatPassword" placeholder="Repetir a Senha">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="inputTelefone"
                                        placeholder="Telefone com DDD">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="inputCNPJ"
                                        placeholder="CNPJ">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="inputRazao"
                                        placeholder="Razão Social">
                                </div>
                                <div class="form-group">
                                    <select class="form-select-lg form-control" id="inputSegmento">
                                        <option selected>Escolha o seguimento</option>
                                        <option value="1">Seguimento 1</option>
                                        <option value="2">Seguimento 2</option>
                                        <option value="3">Seguimento 3</option>
                                    </select>
                                </div>
                                <div class="btn btn-primary btn-user btn-block" onclick="submit()">
                                    Criar Conta
                                </div>
                                
                                <script>
                                        
                                </script>
                                <script>
                                    function submit(){
                                        let nome = document.getElementById('inputNome').value
                                        let email = document.getElementById('inputEmail').value

                                        let senha = document.getElementById('inputPassword').value
                                        let resenha = document.getElementById('repeatPassword').value

                                        if(senha != resenha){
                                            alert('Senhas não conferem!')
                                            return
                                        }

                                        let telefone = document.getElementById('inputTelefone').value

                                        if(telefone.length < 11){
                                            alert('Numero de telefone inválido!')
                                            return
                                        }

                                        let cnpj = document.getElementById('inputCNPJ').value
                                        let razao = document.getElementById('inputRazao').value
                                        //let segmento = document.getElementById('inputSeguimento').value*/

                                        if(nome.trim() && email.trim() && telefone.trim(), cnpj.trim() && razao.trim()){
                                            $.get('actions/register-action.php', {nome:nome, email:email, telefone:telefone, cnpj:cnpj, razao:razao}, function(response){
                                                alert(response)
                                            })
                                        }else{
                                            alert('Preencha os campos corretamente!')
                                        }
                                    }
                                </script>
                                <a href="actions/google-oauth2-register.php" class="btn btn-google btn-user btn-block" hidden>
                                    <i class="fab fa-google fa-fw"></i> Registrar com Google
                                </a>
                            </form>
                            <hr>
                            <div class="text-center" hidden>
                                <a class="small" href=">recovery.php">Esqueceu a senha?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="index.php">Já tem uma conta? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>