<?php

/**
 * Descricao de ControleArtigo
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ControleDepartamento {

    private $Menu;
    private $Dados;
    private $ArtigoId;
    private $PageId;

    public function index($PageId = null) {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->PageId = ((int) $PageId ? $PageId : 1);
        $ListarArtigos = new ModelsDepartamento();
        $this->Dados = $ListarArtigos->listar($this->PageId);

        $CarregarView = new ConfigView("departamento/listarDepartamento", $this->Menu, $this->Dados);
        $CarregarView->renderizarlogin();
    }

    public function visualizar($ArtigoId = null) {
        $this->ArtigoId = (int) $ArtigoId;
        if ($this->ArtigoId):
            $VerArtigo = new ModelsDepartamento();
            $this->Dados = $VerArtigo->visualizar($this->ArtigoId);
            if ($VerArtigo->getResultado()):
                $CarregarView = new ConfigView('departamento/visualizarDepartamento', NULL, $this->Dados);
                $CarregarView->renderizarlogin();
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um Laboratório!</div>";
                $UrlDestino = URL . 'controle-departamento/index';
                echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
            endif;
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um Laboratório!</div>";
            $UrlDestino = URL . 'controle-departamento/index';
            echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
        endif;
    }

    public function cadastrar() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $CadArtigo = new ModelsDepartamento();
        if (isset($this->Dados['basic-form'])):
            unset($this->Dados['basic-form']);
            $CadArtigo->cadastrar($this->Dados);
            $this->ArtigoId = $CadArtigo->getResultado();
            if (!$CadArtigo->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'><b>Erro ao cadastrar: </b>Para cadastrar o Laboratório preencha todos os campos!</div>";
            else:
                $_SESSION['msg'] = "<div class='alert alert-success'>Laboratório cadastrado com sucesso!</div>";
                $UrlDestino = URL . 'controle-departamento/visualizar/' . $this->ArtigoId;
                echo "<script type='text/javascript'> chamarTela('$UrlDestino') </script>";
            endif;
        endif;

        $Registro = $CadArtigo->listarCadastrar();
        $this->Dados = array($Registro[0], $this->Dados);
        $CarregarView = new ConfigView("departamento/cadastrarDepartamento", NULL, $this->Dados);
        $CarregarView->renderizarlogin();
    }

    public function editar($ArtigoId = null) {
        $this->ArtigoId = (int) $ArtigoId;
        if (!empty($this->ArtigoId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPrivado();

            $EditaArtigo = new ModelsDepartamento();
            $Registro = $EditaArtigo->listarCadastrar();
            $this->Dados = array($Registro[0], $this->Dados);
            $CarregarView = new ConfigView('departamento/editarDepartamento', NULL, $this->Dados);
            $CarregarView->renderizarlogin();

        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um Laboratório</div>";
            $UrlDestino = URL . 'controle-departamento/index';
            echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
        endif;
    }

    public function alterarPrivado() {
        if (!empty($this->Dados['basic-form'])):
            unset($this->Dados['basic-form']);
            $EditarArtigo = new ModelsDepartamento();
            $EditarArtigo->editar($this->ArtigoId, $this->Dados);
            if (!$EditarArtigo->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para editar o Laboratório preencha todos os campos!</div>";
            else:
                $_SESSION['msg'] = "<div class='alert alert-success'>Laboratório editado com sucesso!</div>";
                $UrlDestino = URL . 'controle-departamento/visualizar/' . $this->ArtigoId;
//                header("Location: $UrlDestino");
                echo "<script type='text/javascript'> chamarTela('$UrlDestino') </script>";
            endif;
        else:
            $VerArtigo = new ModelsDepartamento();
            $this->Dados = $VerArtigo->visualizar($this->ArtigoId);
            if ($VerArtigo->getRowCount() <= 0):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um Laboratório</div>";
                $UrlDestino = URL . 'controle-departamento/index';
                echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
            endif;
        endif;
    }

    public function apagar($ArtigoId = null) {
        $this->ArtigoId = (int) $ArtigoId;
        if (!empty($this->ArtigoId)):
            $ApagarArtigo = new ModelsDepartamento();
            $ApagarArtigo->apagar($this->ArtigoId);
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um Laboratório!</div>";
            $UrlDestino = URL . 'controle-departamento/index';
            echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
        endif;
        $UrlDestino = URL . 'controle-departamento/index';
        echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
    }

}
