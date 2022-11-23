<?php

/**
 * Descricao de ControleArtigo
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ControleArmazem {

    private $Menu;
    private $Dados;
    private $ArtigoId;
    private $PageId;

    public function index($PageId = null) {

        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->PageId = ((int) $PageId ? $PageId : 1);
        $ListarArtigos = new ModelsArmazem();
        $this->Dados = $ListarArtigos->listar($this->PageId);
        $CarregarView = new ConfigView("armazem/listarArmazem", $this->Menu, $this->Dados);
        $CarregarView->renderizarlogin();
    }

    public function stock($PageId = null) {

        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->PageId = ((int) $PageId ? $PageId : 0);
        $ListarArtigos = new ModelsArtigoArmazem();
        $this->Dados = $ListarArtigos->listar($this->PageId);
        $CarregarView = new ConfigView("armazem/artigo_armazem/listarStok", $this->Menu, $this->Dados);
        $CarregarView->renderizarlogin();
    }

    public function visualizar($ArtigoId = null) {
//        $ListarMenu = new ModelsMenu();
//        $this->Menu = $ListarMenu->listar();
        $this->ArtigoId = (int) $ArtigoId;
        if ($this->ArtigoId):
            $VerArtigo = new ModelsArmazem();
            $this->Dados = $VerArtigo->visualizar($this->ArtigoId);
            if ($VerArtigo->getResultado()):
                $CarregarView = new ConfigView('armazem/visualizarArmazem', NULL, $this->Dados);
                $CarregarView->renderizarlogin();
            else:
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um armazem!</div>";
                $UrlDestino = URL . 'controle-armazem/index';
                echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
            endif;
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um armazem!</div>";
            $UrlDestino = URL . 'controle-armazem/index';
            echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
        endif;
    }

    public function cadastrar() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $CadArtigo = new ModelsArmazem();
        if ($this->Dados['basic-form']):
            unset($this->Dados['basic-form']);
            $CadArtigo->cadastrar($this->Dados);
            $this->ArtigoId = $CadArtigo->getResultado();
            if (!$CadArtigo->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'><b>Erro ao cadastrar: </b>Para cadastrar o armazem preencha todos os campos!</div>";
            else:
                $_SESSION['msg'] = "<div class='alert alert-success'>Armazem cadastrado com sucesso!</div>";
//                $UrlDestino = URL . 'controle-armazem/index';
                $UrlDestino = URL . 'controle-armazem/visualizar/' . $this->ArtigoId;
                echo "<script type='text/javascript'> chamarTela('$UrlDestino') </script>";
            endif;
        endif;

        $Registro = $CadArtigo->listarCadastrar();
        $this->Dados = array($Registro[0], $this->Dados);
        $CarregarView = new ConfigView("armazem/cadastrarArmazem", NULL, $this->Dados);
        $CarregarView->renderizarlogin();
    }

    public function editar($ArtigoId = null) {
        $this->ArtigoId = (int) $ArtigoId;
        if (!empty($this->ArtigoId)):
            $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            $this->alterarPrivado();

            $EditaArtigo = new ModelsArmazem();
            $Registro = $EditaArtigo->listarCadastrar();
            $this->Dados = array($Registro[0], $this->Dados);
            $CarregarView = new ConfigView('armazem/editarArmazem', NULL, $this->Dados);
            $CarregarView->renderizarlogin();

        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um Armazem</div>";
            $UrlDestino = URL . 'controle-armazem/index';
            echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
        endif;
    }

    public function alterarPrivado() {
        if (!empty($this->Dados['basic-form'])):
            unset($this->Dados['basic-form']);
            $EditarArtigo = new ModelsArmazem();
            $EditarArtigo->editar($this->ArtigoId, $this->Dados);
            if (!$EditarArtigo->getResultado()):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Para editar o Armazem preencha todos os campos!</div>";
            else:
                $_SESSION['msg'] = "<div class='alert alert-success'>Armazem editado com sucesso!</div>";
                $UrlDestino = URL . 'controle-armazem/visualizar/' . $this->ArtigoId;
                // header("Location: $UrlDestino");
                echo "<script type='text/javascript'> chamarTela('$UrlDestino') </script>";
            endif;
        else:
            $VerArtigo = new ModelsArmazem();
            $this->Dados = $VerArtigo->visualizar($this->ArtigoId);
            if ($VerArtigo->getRowCount() <= 0):
                $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um Armazem</div>";
                $UrlDestino = URL . 'controle-armazem/index';
                echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";

            endif;
        endif;
    }

    public function apagar($ArtigoId = null) {
        $this->ArtigoId = (int) $ArtigoId;
        if (!empty($this->ArtigoId)):
            $ApagarArtigo = new ModelsArmazem();
            $ApagarArtigo->apagar($this->ArtigoId);
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Necessário selecionar um Armazem!</div>";
            $UrlDestino = URL . 'controle-armazem/index';
            echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
        endif;
        $UrlDestino = URL . 'controle-armazem/index';
        echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
    }

    public function adicionarArtigo($id_armazem) {
        if (!isset($_SESSION['nota_recepcao' . $_SESSION['id']])) {
            $_SESSION['msgerr'] = "<div class='alert alert-danger'>Adicione a nota de recepção!</div>";
            $UrlDestino = URL . 'controle-armazem/index';
            header("Location: $UrlDestino");
        }
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $CadNivelAcesso = new ModelsArtigoArmazem();

        if (!empty($this->Dados['SendCadArtigo'])):
            unset($this->Dados['SendCadArtigo']);

            $id_artigo = $this->Dados['id_artigo'];
            $validade = $this->Dados['validade'];
            $preco = $this->Dados['preco'];
            $iva = $this->Dados['iva'];


            $CadNivelAcesso->verificarArtigo($this->Dados['id_artigo'], $this->Dados['id_nota_recepcao']);
            if ($CadNivelAcesso->getRowCount() == 0) {
                if ($this->Dados['quantidade_rebida'] <= $this->Dados['quantidade_encomendada']) {

                    $cadNotaRecepcao = new ModelsNotaRecepcao();

                    unset($this->Dados['id_artigo']);
                    unset($this->Dados['validade']);
                    unset($this->Dados['iva']);
                    unset($this->Dados['preco']);

                    $cadNotaRecepcao->cadastrar($this->Dados);

                    $stock = array(
                        'nota_recepcao_entrada_id' => $cadNotaRecepcao->getResultado(),
                        'id_artigo' => $id_artigo,
                        'id_armazem' => $id_armazem,
                        'validade' => date("Y-m-d", strtotime($validade)),
                        'quantidade' => $this->Dados['quantidade_rebida'],
                        'iva' => $iva,
                        'preco' => $preco,
                        'created' => $this->Dados['created']
                    );

                    $CadNivelAcesso->cadastrar($stock);
                    if ($CadNivelAcesso->getResultado()):
                        $_SESSION['msgcad'] = "<div class='alert alert-success'>Artigo adiconado com sucesso!</div>";
                        $UrlDestino = URL . 'controle-artigo-armazem/index';
                    //  header("Location: $UrlDestino");

                    else:
                        $_SESSION['msg'] = "<div class='alert alert-danger'>Para adicionar artigo preencha todos os campos!</div>";
                    endif;
                } else {
                    $_SESSION['msg'] = "<div class='alert alert-danger'>A quantidade encomendada não pode ser menor que a quantidade recebida!</div>";
                }
            } else {
                $_SESSION['msg'] = "<div class='alert alert-danger'>Selecione um artigo diferente para esta <b>Factura!</b> ou elimine o artigo selecionado na lista</div>";
            }

        endif;

        if (!empty($this->Dados['SendDeletArtigo'])):
            unset($this->Dados['SendDeletArtigo']);
            // var_dump($this->Dados);
            // die();
            if (!empty($this->Dados['id'])):

                $ApagarArtigo = new ModelsArtigoArmazem();
                $ApagarArtigo->apagar($this->Dados['id']);

                $ApagarEntrada = new ModelsNotaRecepcao();
                $ApagarEntrada->apagar($this->Dados['id']);


            else:
                $_SESSION['msgCota'] = "<div class='alert alert-danger'>Necessário selecionar um artigo!</div>";
                $UrlDestino = URL . 'controle-empresa/index';
            //header("Location: $UrlDestino");
            endif;

        endif;

        $Registro = $CadNivelAcesso->listarCadastrar();
        if (isset($_SESSION['nota_recepcao' . $_SESSION['id']])) {
            $listaCad = $CadNivelAcesso->buscarListaCad($_SESSION['nota_recepcao' . $_SESSION['id']]);
        } else {
            $listaCad = array();
        }
        $Registro['id_armazem'] = $id_armazem;
        $this->Dados = array($this->Dados, $Registro, $listaCad);
        $CarregarView = new ConfigView('armazem/artigo_armazem/adicionarArtigo', $this->Menu, $this->Dados);
        $CarregarView->renderizarForm();
    }

    public function terminar() {
        if (isset($_SESSION['nota_recepcao' . $_SESSION['id']])) {
            unset($_SESSION['nota_recepcao' . $_SESSION['id']]);
            $_SESSION['msgerr'] = "<div class='alert alert-success'>Registo terminado com sucesso!</div>";
            $UrlDestino = URL . 'controle-armazem/index';
            echo "<script type='text/javascript'> enviaDados('$UrlDestino',null,'content') </script>";
        }
    }

}
