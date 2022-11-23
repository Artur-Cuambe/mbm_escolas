<?php

/**
 * Descricao de ControleUsuario
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ControleUsuario {

    private $Menu;
    private $Dados;
    private $UserId;
    private $PageId;

    public function index($PageId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->PageId = ((int) $PageId ? $PageId : 1);
        //echo "Número da página: {$this->PageId}<br>";
        $ListarUsuarios = new ModelsUsuario();
        $this->Dados = $ListarUsuarios->listar($this->PageId);
        $CarregarView = new ConfigView("usuario/listarUsuario", $this->Menu, $this->Dados);
        $CarregarView->renderizarlogin();
    }

    public function cadastrar() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $CadUsuario = new ModelsUsuario();
        if (!empty($this->Dados['basic-form'])):
            unset($this->Dados['basic-form']);
            $this->Dados['foto'] = ($_FILES['foto'] ? $_FILES['foto'] : null);

            $CadUsuario->cadastrar($this->Dados);
            if (!$CadUsuario->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> <b>Erro ao registar: </b>Para cadastrar o utilizador preencha todos os campos!
                  </div>";
            else:
                $_SESSION['msgcad'] = "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> Utilizador registado com sucesso!
                  </div>";
                echo "<script type='text/javascript'> window.location = ''; </script>";
            endif;
        endif;

        $Registros = $CadUsuario->listarCadastrar();
        $this->Dados = array($Registros[0], $Registros[1], $this->Dados);
        $CarregarView = new ConfigView("usuario/cadastrarUsuario", NULL, $this->Dados);
        $CarregarView->renderizarlogin();
    }

    public function visualizar($UserId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->UserId = (int) $UserId;
        if (!empty($this->UserId)):
            $VerUsuario = new ModelsUsuario();
            $this->Dados = $VerUsuario->visualizar($UserId);

            if ($VerUsuario->getResultado()):
                $CarregarView = new ConfigView("usuario/visualizarUsuario", $this->Menu, $this->Dados);
                $CarregarView->renderizarlogin();
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> Necessário seleciona um Utilizador!
                  </div>";
                $UrlDestino = URL . 'controle-usuario/index';
                header("Location: $UrlDestino");
            endif;

        else:
            $_SESSION['msg'] = "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> Necessário seleciona um Utilizador!
                  </div>";
            $UrlDestino = URL . 'controle-usuario/index';
            header("Location: $UrlDestino");
        endif;
    }

    public function verPerfil() {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->UserId = (int) $_SESSION['id'];
        if (!empty($this->UserId)):
            $VerUsuario = new ModelsUsuario();
            $this->Dados = $VerUsuario->visualizar($this->UserId);
            if ($VerUsuario->getResultado()):
                $CarregarView = new ConfigView('usuario/verPerfil', $this->Menu, $this->Dados);
                $CarregarView->renderizarlogin();
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> Area Restrita!
                  </div>";
                $UrlDestino = URL . 'controle-login/login';
                header("Location: $UrlDestino");
            endif;
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> Area Restrita!
                  </div>";
            $UrlDestino = URL . 'controle-login/login';
            header("Location: $UrlDestino");
        endif;
    }

    public function editar($UserId = null) {
        $this->UserId = (int) $UserId;
        if (!empty($this->UserId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPrivado();

            $EditaUsuario = new ModelsUsuario();
            $Registros = $EditaUsuario->listarCadastrar();
            //var_dump($Registros);
            $this->Dados = array($Registros[0], $Registros[1], $this->Dados);
            $CarregarView = new ConfigView("usuario/editarUsuario", NULL, $this->Dados);
            $CarregarView->renderizarlogin();
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> Necessário seleciona um Utilizador!
                  </div>";
            $UrlDestino = URL . 'controle-usuario/index';
            header("Location: $UrlDestino");
        endif;
    }

    private function alterarPrivado() {
        if (!empty($this->Dados['basic-form'])):
            unset($this->Dados['basic-form']);
            $this->Dados['foto'] = ($_FILES['foto'] ? $_FILES['foto'] : null);
            $EditaUsuario = new ModelsUsuario();
            $EditaUsuario->editar($this->UserId, $this->Dados);
            if (!$EditaUsuario->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para editar o usuário preencha todos os campos!</div>";
            else:
                $_SESSION['msg'] = "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> Usuário editado com sucesso!
                  </div>";
                echo "<script type='text/javascript'> window.location = ''; </script>";
            endif;
        else:
            $VerUsuario = new ModelsUsuario();
            $this->Dados = $VerUsuario->visualizar($this->UserId);
            if ($VerUsuario->getRowCount() <= 0):
                $_SESSION['msg'] = "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> Necessário seleciona um Utilizador!
                  </div>";
                $UrlDestino = URL . 'controle-usuario/index';
                header("Location: $UrlDestino");
            endif;
        //var_dump($this->Dados);
        endif;
    }

    public function editarPerfil() {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->UserId = (int) $_SESSION['id'];
        if (!empty($this->UserId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPerfilPrivado();

            $CarregarView = new ConfigView("usuario/editarPerfil", $this->Menu, $this->Dados);
            $CarregarView->renderizarlogin();
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> Area Restrita!
                  </div>";
            $UrlDestino = URL . 'controle-login/login';
            header("Location: $UrlDestino");
        endif;
    }

    private function alterarPerfilPrivado() {
        if (!empty($this->Dados['basic-form'])):
            unset($this->Dados['basic-form']);
            $this->Dados['foto'] = ($_FILES['foto'] ? $_FILES['foto'] : null);
            $EditarUsuario = new ModelsUsuario();
            $EditarUsuario->editar($this->UserId, $this->Dados);
            if (!$EditarUsuario->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> <b>Erro ao editar: </b>Para editar o utilizador preencha todos os campos!
                  </div>";
            else:
                $AtualizarSessao = new ModelsUsuario();
                $AtualizarSessao->atualizaSessao($this->UserId);
                $_SESSION['msgcad'] = "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> Utilizador editado com sucesso!
                  </div>";
               echo "<script type='text/javascript'> window.location = ''; </script>";
            endif;
        else:
            $VerUsuario = new ModelsUsuario();
            $this->Dados = $VerUsuario->visualizar($this->UserId);
        endif;
    }

    public function apagar($UserId = null) {
        $this->UserId = (int) $UserId;
        if (!empty($this->UserId)):
           // echo "<img src='" + URL + "assets/assets/images/loader.gif' width='50' height='50' alt='Carregando...'/>";
            $ApagarUsuario = new ModelsUsuario();
            $ApagarUsuario->apagar($this->UserId);
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> Necessário seleciona um Utilizador!
                  </div>";
          echo "<script type='text/javascript'> window.location = ''; </script>";
        endif;

         echo "<script type='text/javascript'> window.location = ''; </script>";
    }

    public function registar() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $CadUsuario = new ModelsUsuario();
        if (!empty($this->Dados['SendCadUsuario'])):
            unset($this->Dados['SendCadUsuario']);
            $CadUsuario->registar($this->Dados);
            if (!$CadUsuario->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> <b>Erro ao registar: </b>Para cadastrar o usuário preencha todos os campos!
                  </div>";
            else:
                unset($this->Dados['name']);
                unset($this->Dados['created']);
                unset($this->Dados['niveis_acesso_id']);
                unset($this->Dados['situacoes_user_id']);
                $Login = new ModelsLogin();
                $Login->logar($this->Dados);
                if (!$Login->getResultado()):
                    $_SESSION['msg'] = $Login->getMsg();
                else:
                    $this->Dados = $Login->getResultado();

                    $AtualizarSessao = new ModelsUsuario();
                    $AtualizarSessao->atualizaSessao($this->Dados[0]['id']);
                    $_SESSION['msglogado'] = "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> Conta criada com sucesso!
                  </div>";
                    $UrlDestino = URL . 'controle-home/index';
                    header("Location: $UrlDestino");
                endif;

//                $_SESSION['msgcad'] = "<div class='alert alert-success'>Usuário cadastrado com sucesso!</div>";
//                $UrlDestino = URL . 'controle-usuario/index';
//                header("Location: $UrlDestino");
            endif;
        endif;

        $CarregarView = new ConfigView("usuario/registar", null, $this->Dados);
        $CarregarView->renderizarlogin();
    }

}
