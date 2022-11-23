<?php

/**
 * Descricao de ControleArtigo
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ControleNota {

    private $Menu;
    private $Dados;
    private $ArtigoId;
    private $PageId;

    public function cadastrar($id_armazem) {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $CadArtigo = new ModelsNota();
        if ($this->Dados['basic-form']):
            unset($this->Dados['basic-form']);
            $this->Dados['id_armazem'] = $id_armazem;
            $CadArtigo->cadastrar($this->Dados);
            if (!$CadArtigo->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'><b>Erro ao registar: </b>Para registar a nota de recepção preencha todos os campos!</div>";
            else:
                $_SESSION['msgcad'] = "<div class='alert alert-success'>Nota gerada com sucesso!</div>";
                $_SESSION['nota_recepcao'.$_SESSION['id']] = $CadArtigo->getResultado();
                $UrlDestino = URL . 'controle-armazem/adicionar-artigo/' . $id_armazem;
//                header("Location: $UrlDestino");
                echo "<script type='text/javascript'> window.location = '$UrlDestino'; </script>";
            endif;
        endif;
        $this->Dados = array('id_armazem' => $id_armazem);

        $CarregarView = new ConfigView("nota_recepcao/cadastrarNota", NULL, $this->Dados);
        $CarregarView->renderizarlogin();
    }

}
