<?php

/**
 * Descricao de ControleLogin
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ControleLogin {

    private $Menu;
    private $Dados;
    private $IdMethodo;
    private $Chave;

    public function login() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['SendLogin'])):
            unset($this->Dados['SendLogin']);
            $Login = new ModelsLogin();
            $Login->logar($this->Dados);
            if (!$Login->getResultado()):
                $_SESSION['msg'] = $Login->getMsg();
            else:
                $this->Dados = $Login->getResultado();
                $_SESSION['msglogado'] = $Login->getMsg();
                $AtualizarSessao = new ModelsUsuario();
                $AtualizarSessao->atualizaSessao($this->Dados[0]['id']);

                if ($_SESSION['niveis_acesso_id'] == 1) {
                    $UrlDestino = URL . 'controle-home/index';
                    header("Location: $UrlDestino");
                } else {
                    $UrlDestino = URL . 'controle-home/index';
                    header("Location: $UrlDestino");
                }

            endif;
        else:
            $this->Dados = null;
        endif;

        $CarregarView = new ConfigView("login/login", $this->Dados);
        $CarregarView->renderizarlogin();
    }

    public function logout() {
        unset($_SESSION['id'], $_SESSION['name'], $_SESSION['email'], $_SESSION['niveis_acesso_id']);
        $_SESSION['msg'] = "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> Deslogado com sucesso.
                  </div>";
        $UrlDestino = URL . 'controle-login/login';
        header("Location: $UrlDestino");
    }

    public function recuperarSenha() {
        $CarregarView = new ConfigView('login/recuperarSenha');
        $CarregarView->renderizarlogin();
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (!empty($this->Dados['SendRecupSenha'])):
            unset($this->Dados['SendRecupSenha']);
            $RecuperarSenha = new ModelsRecuperarSenha();
            $RecuperarSenha->recuperarSenha($this->Dados);
            if ($RecuperarSenha->getResultado()):
                $_SESSION['msgcad'] = "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> Dados de recuperação enviados para o seu e-mail!
                  </div>";
                $UrlDestino = URL . 'controle-login/login';
                header("Location: $UrlDestino");
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> E-mail inválido!
                  </div>";
                $UrlDestino = URL . 'controle-login/recuperar-senha';
                header("Location: $UrlDestino");
            endif;
        endif;
    }

    public function atualizarSenha($Chave = null) {
        $this->Chave = $Chave;
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $this->atualizarSenhaPrivado();

        $CarregarView = new ConfigView('login/atualizaSenha');
        $CarregarView->renderizarlogin();
    }

    public function atualizarSenhaPrivado() {
        if (!empty($this->Dados['SendAtualSenha'])):
            unset($this->Dados['SendAtualSenha']);
            $this->Dados['recuperar_senha'] = $this->Chave;
            $AtualizarSenha = new ModelsRecuperarSenha();
            $AtualizarSenha->atualizarSenha($this->Chave, $this->Dados);

            if (!$AtualizarSenha->getResultado()) :
                $_SESSION['msg'] = "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> Erro ao atualizar a senha!
                  </div>";
            else:
                $_SESSION['msgcad'] = "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> Senha atualizada com sucesso!
                  </div>";
                $UrlDestino = URL . 'controle-login/login';
                header("Location: $UrlDestino");
            endif;

        endif;
    }

    public function listarClasseMethodo() {
       //$ListarMenu = new ModelsMenu();
       // $this->Menu = $ListarMenu->listar();

        $Listar = new ModelsLogin();
        $this->Dados = $Listar->listar();
        $CarregarView = new ConfigView("login/listarClasseMethodo", NULL, $this->Dados);
        $CarregarView->renderizarlogin();
    }

    public function cadastrarClasse() {
        $CadClasse = new ModelsLogin();
        $CadClasse->cadastrarClasse();
        $_SESSION['msg'] = "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> Sincronizado com sucesso
                  </div>";
        $UrlDestino = URL . 'controle-login/listar-classe-methodo';
        //header("Location: $UrlDestino");
       echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
    }

    public function editarPermissao($MethodoId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->IdMethodo = (int) $MethodoId;
        //echo "Método: {$this->IdMethodo}<br>";
        if (!empty($this->IdMethodo)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->Dados['id_metodo'] = $this->IdMethodo;

            $this->alterarPrivado();

            $CarregarView = new ConfigView("login/editarPermissao", $this->Menu, $this->Dados);
            $CarregarView->renderizarlogin();
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> Necessário selecionar um Método
                  </div>";
            $UrlDestino = URL . 'controle-login/listar-classe-methodo';
            header("Location: $UrlDestino");
        endif;
    }

    private function alterarPrivado() {
        if (!empty($this->Dados['basic-form'])):
            //var_dump($this->Dados);
            unset($this->Dados['basic-form']);
            $EditarPermissao = new ModelsLogin();
            $EditarPermissao->editarPermissoes($this->IdMethodo, $this->Dados);

            if (!$EditarPermissao->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> Erro ao editar a permissão
                  </div>";
                $UrlDestino = URL . 'controle-login/listar-classe-methodo';
                header("Location: $UrlDestino");
            else:
                $_SESSION['msg'] = "<div class='alert alert-success alert-dismissible' role='alert'>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <i class='fa fa-times-circle'></i> Permissão editada com sucesso
                  </div>";
                $UrlDestino = URL . 'controle-login/listar-classe-methodo';
                header("Location: $UrlDestino");
            endif;

        else:
            $VerPermissao = new ModelsLogin();
            $this->Dados = $VerPermissao->listar($this->IdMethodo);
        endif;
    }

}
