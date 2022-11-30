<?php

/**
 * Descricao de ControleArtigo
 *
 * @copyright (c) 2022, Artur Cuambe
 */
class ControleInscricao {

    private $Menu;
    private $Dados;
    private $inscricaoId;
    private $PageId;

    public function index($PageId = null) {
        $this->PageId = ((int) $PageId ? $PageId : 1);
        $ListarArtigos = new ModelsInscricao();
        $this->Dados = $ListarArtigos->listar($this->PageId);

        $CarregarView = new ConfigView("inscricao/views/listarInscricao", $this->Menu, $this->Dados);
        $CarregarView->renderizarModule();
    }

    public function visualizar($inscricaoId = null) {
        $this->inscricaoId = (int) $inscricaoId;
        if ($this->inscricaoId):
            $VerArtigo = new ModelsInscricao();
            $this->Dados = $VerArtigo->visualizar($this->inscricaoId);
            if ($VerArtigo->getResultado()):
                $CarregarView = new ConfigView('inscricao/views/visualizarInscricao', NULL, $this->Dados);
                $CarregarView->renderizarModule();
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um estudante!</div>";
                $UrlDestino = URL . 'controle-inscricao/index';
                echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
            endif;
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um estudante!</div>";
            $UrlDestino = URL . 'controle-inscricao/index';
            echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
        endif;
    }

    public function cadastrar($estudanteId = null) {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $CadArtigo = new ModelsInscricao();
        if (isset($this->Dados['basic-form'])):
            unset($this->Dados['basic-form']);
            $CadArtigo->cadastrar($this->Dados);
            $this->inscricaoId = $CadArtigo->getResultado();
            if (!$CadArtigo->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'><b>Erro ao cadastrar: </b>Para inscrever o estudante preencha todos os campos!</div>";
            elseif($CadArtigo->getMsg()!=NULL):
                    $_SESSION['msg'] = "<div class='alert alert-danger'>{$CadArtigo->getMsg()}</div>";
            else:
                $_SESSION['msg'] = "<div class='alert alert-success'>Estudante inscrito com sucesso!</div>";
                $UrlDestino = URL . 'controle-inscricao/visualizar/' . $this->inscricaoId;
                echo "<script type='text/javascript'> chamarTela('$UrlDestino') </script>";
            endif;
        endif;

        $Registro = $CadArtigo->listarCadastrar();
        $this->Dados = array($Registro[0],$Registro[1],$Registro[2],$Registro[3], $this->Dados,$estudanteId);
        $CarregarView = new ConfigView("inscricao/views/cadastrarInscricao", NULL, $this->Dados);
        $CarregarView->renderizarModule();
    }

    public function editar($inscricaoId = null) {
        $this->inscricaoId = (int) $inscricaoId;
        if (!empty($this->inscricaoId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPrivado();

            $EditaArtigo = new ModelsInscricao();
            $Registro = $EditaArtigo->listarCadastrar();
            $this->Dados = array($Registro[0],$Registro[1],$Registro[2],$Registro[3], $this->Dados);
            $CarregarView = new ConfigView('inscricao/views/editarInscricao', NULL, $this->Dados);
            $CarregarView->renderizarModule();

        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um estudante</div>";
            $UrlDestino = URL . 'controle-inscricao/index';
            echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
        endif;
    }

    public function alterarPrivado() {
        if (!empty($this->Dados['basic-form'])):
            unset($this->Dados['basic-form']);
            $EditarArtigo = new ModelsInscricao();
            $EditarArtigo->editar($this->inscricaoId, $this->Dados);
            if (!$EditarArtigo->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para editar o estudante preencha todos os campos!</div>";
            else:
                $_SESSION['msg'] = "<div class='alert alert-success'>estudante editado com sucesso!</div>";
                $UrlDestino = URL . 'controle-inscricao/visualizar/' . $this->inscricaoId;
//                header("Location: $UrlDestino");
                echo "<script type='text/javascript'> chamarTela('$UrlDestino') </script>";
            endif;
        else:
            $VerArtigo = new ModelsInscricao();
            $this->Dados = $VerArtigo->visualizar($this->inscricaoId);
            if ($VerArtigo->getRowCount() <= 0):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um estudante</div>";
                $UrlDestino = URL . 'controle-inscricao/index';
                echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
            endif;
        endif;
    }

    public function apagar($inscricaoId = null) {
        $this->inscricaoId = (int) $inscricaoId;
        if (!empty($this->inscricaoId)):
            $ApagarArtigo = new ModelsInscricao();
            $ApagarArtigo->apagar($this->inscricaoId);
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um estudante!</div>";
            $UrlDestino = URL . 'controle-inscricao/index';
            echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
        endif;
        $UrlDestino = URL . 'controle-inscricao/index';
        echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
    }

}