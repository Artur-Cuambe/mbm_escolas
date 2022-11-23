<!DOCTYPE html>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>LOGIN</title>
        <link rel="icon" href="<?php echo URL; ?>assets/img/up.png">
        <link rel="stylesheet" href="<?php echo URL; ?>assets/plugins/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo URL; ?>assets/css/auth.css">
    </head>

    <body>
        <div class="lowin lowin-blue">
            <div class="lowin-brand">
               <img src="<?php echo URL; ?>assets/img/up.png" alt="logo">
            </div>
            <div class="lowin-wrapper">
                <div class="lowin-box lowin-login">
                    <div class="lowin-box-inner">
                        <form method="POST" action="" name="login">

                            <?php
                            if (isset($_SESSION['msg'])):
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            else:
                                echo '<p>Área Restrita</p>';
                            endif;
                            if (isset($_SESSION['msgcad'])):
                                echo $_SESSION['msgcad'];
                                unset($_SESSION['msgcad']);
                            endif;
                            ?>

                            <div class="lowin-group">
                                <label>Email <a href="#" class="login-back-link">Sign in?</a></label>
                                <input type="email" autocomplete="email" name="email" class="lowin-input">
                            </div>
                            <div class="lowin-group password-group">
                                <label>Password <a href="#" class="forgot-link"></a></label>
                                <input type="password" name="password" autocomplete="current-password" class="lowin-input">
                            </div>
                            <button value="Acessar" name="SendLogin" class="lowin-btn login-btn">
                                Acessar
                            </button>

                            <div class="text-foot">
                                Esqueceu a senha? <a href="" class="register-link">Recuperar</a><br><br>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="lowin-box lowin-register">
                    <div class="lowin-box-inner">
                        <form  method="POST" action="" name="recuperar">
                             <?php
                            if (isset($_SESSION['msg'])):
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            else:
                                echo '<p>Recuperação de Senha</p>';
                            endif;
                            ?>
                            <div class="lowin-group">
                                <label>Email</label>
                                <input type="email" autocomplete="email" name="email" class="lowin-input">
                            </div>
                            
                            <button  value="Recuperar" name="SendRecupSenha" class="lowin-btn">
                                Recuperar
                            </button>

                            <div class="text-foot">
                                Lembrou? <a href="" class="login-link">Clique aqui</a> para logar.
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <footer class="lowin-footer">
                Copyright <a href="" target="_blank"> <?=date('Y')?></a>
            </footer>
        </div>

        <script src="<?php echo URL; ?>assets/js/auth.js"></script>
        <script>
            Auth.init({
              //  login_url: '#login',
              //  forgot_url: '#forgot'
            });
        </script>
    </body>
</html>


