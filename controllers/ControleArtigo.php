<?php

/**
 * Descricao de ControleArtigo
 *
 * @copyright (c) year, Artur Cuambe
 */
class ControleArtigo {

    private $Menu;
    private $Dados;
    private $ArtigoId;
    private $PageId;

    public function index($PageId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->PageId = ((int) $PageId ? $PageId : 1);
        $ListarArtigos = new ModelsArtigo();
        $this->Dados = $ListarArtigos->listar($this->PageId);
        $CarregarView = new ConfigView("artigo/listarArtigo", $this->Menu, $this->Dados);
        $CarregarView->renderizarlogin();
    }

    public function visualizar($ArtigoId = null) {
        // var_dump($this->Menu);
        $this->ArtigoId = (int) $ArtigoId;
        if (!empty($this->ArtigoId)):
            $VerNivelAcesso = new ModelsArtigo();
            $this->Dados = $VerNivelAcesso->visualizar($this->ArtigoId);
            // var_dump($this->Dados);
            if ($VerNivelAcesso->getResultado()):
                $CarregarView = new ConfigView('artigo/visualizarArtigo', NULL, $this->Dados);
                $CarregarView->renderizarlogin();
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário seleciona um artigo!</div>";
                $UrlDestino = URL . 'controle-artigo/index';
            //header("Location: $UrlDestino");
                echo "<script type='text/javascript'> window.location = ''; </script>";
            endif;
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário seleciona um artigo!</div>";
            $UrlDestino = URL . 'controle-artigo/index';
        // header("Location: $UrlDestino");
            echo "<script type='text/javascript'> window.location = ''; </script>";
        endif;
    }

    public function cadastrar() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $CadNivelAcesso = new ModelsArtigo();
        if (!empty(($this->Dados['basic-form']))):
            unset($this->Dados['basic-form']);
            $CadNivelAcesso->verificarArtigo($this->Dados['cod']);
            if ($CadNivelAcesso->getRowCount() == 0) {
                $CadNivelAcesso->cadastrar($this->Dados);
                if ($CadNivelAcesso->getResultado()):
                    $_SESSION['msgcad'] = "<div class='alert alert-success'>Artigo(s) cadastrado(s) com sucesso!</div>";
                    //echo "<script type='text/javascript'> window.location = ''; </script>";
                    $this->Dados = array();
                else:
                    $_SESSION['msg'] = "<div class='alert alert-danger'>Para registar o(s) artigo(s) preencha todos os campos!</div>";
                endif;
            }else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>O artigo com este código já existe!</div>";
            }

        endif;

        $CarregarView = new ConfigView('artigo/cadastrarArtigo', NULL, $this->Dados);
        $CarregarView->renderizarlogin();
    }

    public function editar($ArtigoId = null) {
        $this->ArtigoId = (int) $ArtigoId;
        if (!empty($this->ArtigoId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPrivado();
            $EditaArtigo = new ModelsArtigo();
            $CarregarView = new ConfigView('artigo/editarArtigo', NULL, $this->Dados);
            $CarregarView->renderizarlogin();

        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um Artigo</div>";
            $UrlDestino = URL . 'controle-artigo/index';
            header("Location: $UrlDestino");
        endif;
    }

    public function alterarPrivado() {
        if (!empty($this->Dados['basic-form'])):
            unset($this->Dados['basic-form']);
            $EditarArtigo = new ModelsArtigo();

            $EditarArtigo->verificarArtigo($this->Dados['cod']);
            if ($EditarArtigo->getRowCount() == 0) :
                $EditarArtigo->editar($this->ArtigoId, $this->Dados);
                if (!$EditarArtigo->getResultado()):
                    $_SESSION['msg'] = "<div class='alert alert-danger'>Para editar o artigo preencha todos os campos!</div>";
                else:
                    $_SESSION['msg'] = "<div class='alert alert-success'>Artigo editado com sucesso!</div>";
                    $UrlDestino = URL . 'controle-artigo/visualizar/' . $this->ArtigoId;
                    header("Location: $UrlDestino");
                //echo "<script type='text/javascript'> window.location = ''; </script>";
                endif;
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>O artigo com este código já existe, altere para um código diferente!</div>";
            endif;

        else:
            $VerArtigo = new ModelsArtigo();
            $this->Dados = $VerArtigo->visualizar($this->ArtigoId);
            if ($VerArtigo->getRowCount() <= 0):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um Armazem</div>";
                $UrlDestino = URL . 'controle-artigo/index';
                //header("Location: $UrlDestino");
                echo "<script type='text/javascript'> window.location = ''; </script>";
            endif;
        endif;
    }

    public function apagar($ArtigoId = null) {
        $this->ArtigoId = (int) $ArtigoId;
        if (!empty($this->ArtigoId)):
            $ApagarArtigo = new ModelsArtigo();
            $ApagarArtigo->apagar($this->ArtigoId);
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um artigo!</div>";
            $UrlDestino = URL . 'controle-artigo/index';
            header("Location: $UrlDestino");
        endif;
        $UrlDestino = URL . 'controle-artigo/index';
        header("Location: $UrlDestino");
        //   echo "<script type='text/javascript'> window.location = ''; </script>";
    }

}
