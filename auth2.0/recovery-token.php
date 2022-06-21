<?php require_once(getenv('tilevu')) ?>
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
                                        <h1 class="h4 text-gray-900 mb-2">Reset de Senha</h1>
                                        <p class="mb-4">Entre com a nova senha e o TOKEN que foi enviado para seu email.</p>
                                    </div>
                                    <form class="user" autocomplete="on" method="POST" action="<?=$url_auth20?>actions/recovery-token-action.php">
                                       <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                placeholder="Nova senha" name="new-password">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                placeholder="Repetir senha" name="re-password">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control form-control-user"
                                                placeholder="TOKEN" name="token">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Resetar Senha
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Criar conta!</a>
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
        </div>
    </div>
</body>
</html>