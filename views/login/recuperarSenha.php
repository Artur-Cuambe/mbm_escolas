<!doctype html>
<html lang="en" class="fullscreen-bg">
    <head>
        <title>Esqueceu sua senha | ZN VENDAS</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <!-- App css -->
        <link href="<?php echo URL; ?>assets/assets/css/bootstrap-custom.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo URL; ?>assets/assets/css/app.min.css" rel="stylesheet" type="text/css" />

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">

        <!-- Favicon -->
        <link rel="shortcut icon" href="<?php echo URL; ?>assets/assets/images/favicon.png">
    </head>
    <body>
        <div id="wrapper" class="d-flex align-items-center justify-content-center">
            <div class="auth-box register">
                <div class="content">
                    <div class="header">
                        <div class="logo text-center"><img src="<?php echo URL; ?>assets/assets/images/logozn.png" width="182" height="21" alt="Klorofil Logo"></div>
                        <p class="lead">Recuperação de Senha</p>
                        <?php
                        if (isset($_SESSION['msg'])):
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        endif;
                        ?>
                    </div>
                    <form class="form-auth-small" method="POST" action="">
                        <div class="form-group">
                            <label for="signin-email" class="control-label sr-only">Email</label>
                            <input type="email" class="form-control" id="signin-email" name="email" placeholder="Digite seu email">
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg btn-block" value="Recuperar" name="SendRecupSenha">RECUPERAR</button>
                        <div class="bottom">
                            <span class="helper-text">Lembrou? <a href="<?php echo URL; ?>controle-login/login">Clique aqui</a> para logar.</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="<?php echo URL; ?>assets/assets/js/vendor.min.js"></script>
        <!-- App -->
        <script src="<?php echo URL; ?>assets/assets/js/app.min.js"></script>
    </body>
</html>