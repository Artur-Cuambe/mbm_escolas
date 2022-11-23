<!doctype html>
<html lang="en" class="fullscreen-bg">
    <head>
        <title>Registar | ZN VENDAS</title>
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
        <!-- WRAPPER -->
        <div id="wrapper" class="d-flex align-items-center justify-content-center">
            <div class="auth-box register">
                <div class="content">
                    <div class="header">
                        <div class="logo text-center"><img src="<?php echo URL; ?>assets/assets/images/logozn.png" width="182" height="21" alt="Klorofil Logo"></div>
                        <p class="lead">Registar Utilizador</p>
                        <?php
                        if (isset($_SESSION['msg'])):
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        endif;
                        ?>
                    </div>
                    <form class="form-auth-small" action="" method="post">
                        <div class="form-group">
                            <label for="signup-name" class="control-label sr-only">Nome</label>
                            <input type="text" class="form-control" id="signup-name" name="name" placeholder="Teu nome" value="<?php
                            if (isset($valorForm['name'])): echo $valorForm['name'];
                            endif;
                            ?>">
                        </div>

                        <div class="form-group">
                            <label for="signup-email" class="control-label sr-only">Email</label>
                            <input type="email" class="form-control" id="signup-email" name="email" placeholder="Teu melhor e-mail" value="<?php
                            if (isset($valorForm['email'])): echo $valorForm['email'];
                            endif;
                            ?>">
                        </div>

                        <div class="form-group">
                            <label for="signup-password" class="control-label sr-only">Password</label>
                            <input type="password" class="form-control" id="signup-password" name="password" placeholder="Senha">
                        </div>

                        <input type="hidden" name="created" value="<?php echo date("Y-m-d H:i:s"); ?>">
                        <input type="hidden" name="situacoes_user_id" value="1">
                        <input type="hidden" name="niveis_acesso_id" value="3">

                        <button type="submit" class="btn btn-primary btn-lg btn-block" value="REGISTAR" name="SendCadUsuario">REGISTAR</button>
                        <div class="bottom">
                            <span class="helper-text">Já está registado no sistema? <a href="<?php echo URL; ?>controle-login/login"> clique aqui</a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END WRAPPER -->
        <script src="<?php echo URL; ?>assets/assets/js/vendor.min.js"></script>
        <!-- App -->
        <script src="<?php echo URL; ?>assets/assets/js/app.min.js"></script>
    </body>
</html>