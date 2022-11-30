<?php

/**
 * Descricao de ControleEstudante
 *
 * @copyright (c) 2022, Artur Cuambe
 */
class ControleEstudante {

    private $Menu;
    private $Dados;
    private $EstudanteId;

   

    public function index($PageId = null) {
        $this->PageId = ((int) $PageId ? $PageId : 1);
        $ListarArtigos = new ModelsEstudante();
        $this->Dados = $ListarArtigos->listar($this->PageId);

        $CarregarView = new ConfigView('estudante/views/listarEstudante', null, $this->Dados);
        $CarregarView->renderizarModule();
    }

    public function cadastrar() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $CadEmpresa = new ModelsEstudante();
        if (!empty($this->Dados['basic-form'])):
            unset($this->Dados['basic-form']);
            $this->invalidarCampos();
            // $this->Dados['foto'] = ($_FILES['foto'] ? $_FILES['foto'] : null);
            // var_dump($this->Dados);
            $CadEmpresa->cadastrar($this->Dados);
            // var_dump($CadEmpresa->getMsg());
            //  die;
            $this->EstudanteId = $CadEmpresa->getResultado();
            if (!$CadEmpresa->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'><b>Erro ao cadastrar: </b>Para cadastrar estudante preencha pelo menos nome, gênero e data de nascimento!</div>";
            elseif($CadEmpresa->getMsg()!=NULL):
                $_SESSION['msg'] = "<div class='alert alert-danger'>{$CadEmpresa->getMsg()}</div>";
            else:
                $_SESSION['msg'] = "<div class='alert alert-success'>Estudante cadastrado com sucesso!</div>";
                $UrlDestino = URL . 'controle-inscricao/cadastrar/' . $this->EstudanteId;
                echo "<script type='text/javascript'> chamarTela('$UrlDestino') </script>";
            endif;
        endif;
        // $resultado = $CadEmpresa->listarCadastrar();
        $this->Dados = array($this->Dados);
        $CarregarView = new ConfigView("estudante/views/cadastrarEstudante", NULL, $this->Dados);
        $CarregarView->renderizarModule();
    }

    public function visualizar($EstudanteId = null) {
        $this->EstudanteId = (int) $EstudanteId;
        if (!empty($this->EstudanteId)):
            $VerEmpresa = new ModelsEstudante();
            $this->Dados = $VerEmpresa->visualizar($this->EstudanteId);
            if ($VerEmpresa->getResultado()):
                $CarregarView = new ConfigView('estudante/views/visualizarEstudante', NULL, $this->Dados);
                $CarregarView->renderizarModule();
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um estudante!</div>";
                $UrlDestino = URL . 'controle-estudante/index';
                echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
            endif;
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar estudante!</div>";
            $UrlDestino = URL . 'controle-estudante/index';
            echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
        endif;
    }

    public function editar($EstudanteId = null) {
        $this->EstudanteId = (int) $EstudanteId;
        if (!empty($this->EstudanteId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPrivado();
            $Listar = new ModelsEstudante();
            // var_dump($Listar->visualizar($this->EstudanteId));
            $this->Dados = array($this->Dados, $Listar->visualizar($this->EstudanteId));

            $CarregarView = new ConfigView("estudante/views/editarEstudante", NULL, $this->Dados);
            $CarregarView->renderizarModule();
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar estundante</div>";
            $UrlDestino = URL . 'controle-estudante/index';
            echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
        endif;
    }

    private function alterarPrivado() {
        if (!empty($this->Dados['basic-form'])):
            unset($this->Dados['basic-form']);
            // $this->Dados['foto'] = ($_FILES['foto'] ? $_FILES['foto'] : null);
            $EditaEmpresa = new ModelsEstudante();
            $this->invalidarCampos();
            $EditaEmpresa->editar($this->EstudanteId, $this->Dados);
            if (!$EditaEmpresa->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para editar estudante preencha todos os campos!</div>";
            else:
                $_SESSION['msg'] = "<div class='alert alert-success'>Estudante editado com sucesso!</div>";
                $UrlDestino = URL . 'controle-estudante/visualizar/' . $this->EstudanteId;
                echo "<script type='text/javascript'> chamarTela('$UrlDestino') </script>";
            endif;
        else:
            $VerEmpresa = new ModelsEstudante();
            $this->Dados = $VerEmpresa->visualizar($this->EstudanteId);

            if ($VerEmpresa->getRowCount() <= 0):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar estudante</div>";
                $UrlDestino = URL . 'controle-estudante/index';
                echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
            endif;
        //var_dump($this->Dados);
        endif;
    }

    public function apagar($EstudanteId = null) {
        $this->EstudanteId = (int) $EstudanteId;
        if (!empty($this->EstudanteId)):
            $ApagarEmpresa = new ModelsEstudante();
            $ApagarEmpresa->apagar($this->EstudanteId);
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar Estudante!</div>";
            $UrlDestino = URL . 'controle-estudante/index';
            echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
        endif;

        $UrlDestino = URL . 'controle-estudante/index';
       echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
    }

    private function invalidarCampos()
    {
        if (empty($this->Dados['email'])) {
            unset($this->Dados['email']);
        } 
        if (empty($this->Dados['telefone'])) {
            unset($this->Dados['telefone']);
        } 
        if (empty($this->Dados['residencia'])) {
            unset($this->Dados['residencia']);
        } 
        if (empty($this->Dados['data_emissao'])) {
            unset($this->Dados['data_emissao']);
        } 
        if (empty($this->Dados['local_emissao'])) {
            unset($this->Dados['local_emissao']);
        } 
        if (empty($this->Dados['numero_documento'])) {
            unset($this->Dados['numero_documento']);
        } 
        if (empty($this->Dados['documento'])) {
            unset($this->Dados['documento']);
        } 
    }

}