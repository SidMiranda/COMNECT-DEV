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
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Confirme seu e-mail</h1>
                                        <p class="mb-4">Enviamos um token para seu email. Insira abaixo para validar sua conta!</p>
                                    </div><br>
                                    <form class="user" autocomplete="on" method="POST" action="<?=$url_auth20?>actions/email-check-action.php">
                                       <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Token" name="token" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Confirmar email
                                        </button>
                                    </form>
                                    <hr>
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