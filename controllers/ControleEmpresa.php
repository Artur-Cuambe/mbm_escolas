<?php

/**
 * Descricao de ControleEmpresa
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ControleEmpresa {

    private $Menu;
    private $Dados;
    private $EmpresaId;

    public function index() {
        $ListarEmpresa = new ModelsEmpresa();
        $this->Dados = $ListarEmpresa->listar();
        $CarregarView = new ConfigView('empresa/listarEmpresa', null, $this->Dados);
        $CarregarView->renderizarlogin();
    }

    public function cadastrar() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $CadEmpresa = new ModelsEmpresa();
        if (!empty($this->Dados['basic-form'])):
            unset($this->Dados['basic-form']);
            $this->Dados['foto'] = ($_FILES['foto'] ? $_FILES['foto'] : null);
            //var_dump($this->Dados);
            $CadEmpresa->cadastrar($this->Dados);
            $this->EmpresaId = $CadEmpresa->getResultado();
            if (!$CadEmpresa->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'><b>Erro ao cadastrar: </b>Para cadastrar faculdade preencha todos os campos!</div>";
            else:
                $_SESSION['msg'] = "<div class='alert alert-success'>Faculdade cadastrado com sucesso!</div>";
                $UrlDestino = URL . 'controle-empresa/visualizar/' . $this->EmpresaId;
                echo "<script type='text/javascript'> chamarTela('$UrlDestino') </script>";
            endif;
        endif;
        $resultado = $CadEmpresa->listarCadastrar();
        $this->Dados = array($this->Dados, $resultado);
        $CarregarView = new ConfigView("empresa/cadastrarEmpresa", NULL, $this->Dados);
        $CarregarView->renderizarlogin();
    }

    public function visualizar($EmpresaId = null) {
        $this->EmpresaId = (int) $EmpresaId;
        if (!empty($this->EmpresaId)):
            $VerEmpresa = new ModelsEmpresa();
            $this->Dados = $VerEmpresa->visualizar($this->EmpresaId);

            if ($VerEmpresa->getResultado()):
                $CarregarView = new ConfigView('empresa/visualizarEmpresa', NULL, $this->Dados);
                $CarregarView->renderizarlogin();
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário seleciona um detalhe faculdade!</div>";
                $UrlDestino = URL . 'controle-empresa/index';
                echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
            endif;
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário seleciona um detalhe faculdade!</div>";
            $UrlDestino = URL . 'controle-empresa/index';
            echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
        endif;
    }

    public function editar($EmpresaId = null) {
        $quarteirao = 0;
        $this->EmpresaId = (int) $EmpresaId;
        if (!empty($this->EmpresaId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPrivado();
            $Listar = new ModelsEmpresa();
            // var_dump($Listar->visualizar($this->EmpresaId));
            $this->Dados = array($this->Dados, $Listar->visualizar($this->EmpresaId));

            $CarregarView = new ConfigView("empresa/editarEmpresa", NULL, $this->Dados);
            $CarregarView->renderizarlogin();
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um detalhe faculdade</div>";
            $UrlDestino = URL . 'controle-empresa/index';
            echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
        endif;
    }

    private function alterarPrivado() {
        if (!empty($this->Dados['basic-form'])):
            unset($this->Dados['basic-form']);
            $this->Dados['foto'] = ($_FILES['foto'] ? $_FILES['foto'] : null);
            $EditaEmpresa = new ModelsEmpresa();
            $EditaEmpresa->editar($this->EmpresaId, $this->Dados);
            if (!$EditaEmpresa->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para editar detalhe faculdade preencha todos os campos!</div>";
            else:
                $_SESSION['msg'] = "<div class='alert alert-success'>Detalhe faculdade editado com sucesso!</div>";
                $UrlDestino = URL . 'controle-empresa/visualizar/' . $this->EmpresaId;
                echo "<script type='text/javascript'> chamarTela('$UrlDestino') </script>";
            endif;
        else:
            $VerEmpresa = new ModelsEmpresa();
            $this->Dados = $VerEmpresa->visualizar($this->EmpresaId);

            if ($VerEmpresa->getRowCount() <= 0):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um detalhe faculdade</div>";
                $UrlDestino = URL . 'controle-empresa/index';
                echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
            endif;
        //var_dump($this->Dados);
        endif;
    }

    public function apagar($EmpresaId = null) {
        $this->EmpresaId = (int) $EmpresaId;
        if (!empty($this->EmpresaId)):
            $ApagarEmpresa = new ModelsEmpresa();
            $ApagarEmpresa->apagar($this->EmpresaId);
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um detalhe faculdade!</div>";
            $UrlDestino = URL . 'controle-empresa/index';
            echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
        endif;

        $UrlDestino = URL . 'controle-empresa/index';
       echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
    }

}
