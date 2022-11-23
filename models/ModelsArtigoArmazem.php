<?php

/**
 * Descricao de ModelsArtigo
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ModelsArtigoArmazem {

    private $Resultado;
    private $ArtigoId;
    private $Dados;
    private $Msg;
    private $RowCount;
    private $ResultadoPaginacao;
    private $Foto;

    function getResultado() {
        return $this->Resultado;
    }

    function getMsg() {
        return $this->Msg;
    }

    function getRowCount() {
        return $this->RowCount;
    }

    public function listar($PageId) {
        $Listar = new ModelsRead();
        $Listar->fullRead("SELECT
                                artigo.cod,
                                artigo.nome,
                                artigo_armazem.preco,
                                artigo_armazem.iva,
                                artigo_armazem.created,
                                artigo_armazem.validade,
                                artigo_armazem.quantidade
                            FROM
                            artigo_armazem
                            INNER JOIN artigo ON artigo_armazem.id_artigo = artigo.id WHERE artigo_armazem.id_armazem='$PageId' order by artigo_armazem.created desc");
        //var_dump($Listar->getResultado());
        if ($Listar->getResultado()):
            $this->Resultado = $Listar->getResultado();
            return $this->Resultado;
        else:
            $this->Resultado = array();
        endif;
    }

    public function visualizar($ArtigoId) {
        $this->ArtigoId = (int) $ArtigoId;
        $Visualizar = new ModelsRead();
        $Visualizar->ExeRead('artigo', "WHERE id =:id LIMIT :limit", "id={$this->ArtigoId}&limit=1");
        //var_dump($Visualizar->getResultado());
        $this->Resultado = $Visualizar->getResultado();
        $this->RowCount = $Visualizar->getRowCount();
        return $this->Resultado;
    }

    public function listarCadastrar() {
        $Listar = new ModelsRead();
        $Listar->ExeRead('unidade_medida');
        $unidade_medida = $Listar->getResultado();
        $Listar->ExeRead('artigo');
        $artigo = $Listar->getResultado();
        $this->Resultado = array($artigo, $unidade_medida);
        return $this->Resultado;
    }

    public function buscarListaCad($Id_nota) {
        $Listar = new ModelsRead();
        $Listar->fullRead("SELECT
                            nota_recepcao_entrada.id,
                            artigo.nome,
                            unidade_medida.descricao AS un_medida,
                            nota_recepcao_entrada.quantidade_encomendada,
                            nota_recepcao_entrada.quantidade_rebida,
                            nota_recepcao_entrada.preco_compra,
                            nota_recepcao_entrada.created
                            FROM
                            nota_recepcao_entrada
                            INNER JOIN artigo_armazem ON artigo_armazem.nota_recepcao_entrada_id = nota_recepcao_entrada.id
                            INNER JOIN artigo ON artigo_armazem.id_artigo = artigo.id
                            INNER JOIN unidade_medida ON nota_recepcao_entrada.unidade_medida_id = unidade_medida.id
                            WHERE nota_recepcao_entrada.id_nota_recepcao ='{$Id_nota}'");
        $this->Resultado = $Listar->getResultado();
        return $this->Resultado;
    }

    public function cadastrar(array $Dados) {
        $this->Dados = $Dados;
        $this->validarDados();
        if ($this->Resultado):

            $this->inserir();

        endif;
    }

    private function validarDados() {
        $this->Dados = array_map('trim', $this->Dados);
        if (in_array('', $this->Dados)):
            $this->Resultado = false;
        else:
            $this->Resultado = true;
        endif;
    }

    private function inserir() {
        $Create = new ModelsCreate;
        $Create->ExeCreate('artigo_armazem', $this->Dados);
        //var_dump($Create);        die();
        if ($Create->getResultado()):
            $this->Resultado = $Create->getResultado();
        endif;
    }

    public function editar($AritgoId, array $Dados) {
        $this->ArtigoId = (int) $AritgoId;
        $this->Dados = $Dados;
        $this->ArtigoId = $this->Dados['id'];

        $this->validarDados();
        if ($this->Resultado):
            $this->alterar();
        endif;
    }

    private function alterar() {
        $Update = new ModelsUpdate();
        $Update->ExeUpdate('artigo', $this->Dados, "WHERE id = :id", "id={$this->ArtigoId}");
//        var_dump($Update);        die();
        if ($Update->getResultado()):
            $this->Resultado = true;
        else:
            $this->Resultado = false;
        endif;
    }

    public function apagar($ArtigoId) {
        $this->ArtigoId = (int) $ArtigoId;
        $this->Dados = $this->visualizar($this->ArtigoId);
        if ($this->getRowCount() >= 0):
            $ApagarArtigo = new ModelsDelete();
            $ApagarArtigo->ExeDelete('artigo_armazem', 'WHERE nota_recepcao_entrada_id =:nota_recepcao_entrada_id', "nota_recepcao_entrada_id={$this->ArtigoId}");
            $this->Resultado = $ApagarArtigo->getResultado();
            //var_dump($this->Resultado);            die();
            $_SESSION['msgApagado'] = "<div class='alert alert-success'>Artigo apagado com sucesso!</div>";
        else:
            $_SESSION['msgApagado'] = "<div class='alert alert-success'>Artigo não foi apagado com sucesso!</div>";
        endif;
    }

//    public function verificarArtigo($cod) {
//        $Visualizar = new ModelsRead();
//        $Visualizar->ExeRead('artigo', "WHERE cod =:cod LIMIT :limit", "cod={$cod}&limit=1");
//        //var_dump($Visualizar->getResultado());
//        $this->Resultado = $Visualizar->getResultado();
//        $this->RowCount = $Visualizar->getRowCount();
//        return $this->Resultado;
//    }
    public function verificarArtigo($id_artigo, $id_nota_entrada) {
        $id_artigo = (int) $id_artigo;
        $Visualizar = new ModelsRead();
        $Visualizar->fullRead("SELECT
                                    nota_recepcao_entrada.id
                                    FROM
                                    nota_recepcao_entrada
                                    INNER JOIN artigo_armazem ON artigo_armazem.nota_recepcao_entrada_id = nota_recepcao_entrada.id
                                    WHERE nota_recepcao_entrada.id_nota_recepcao ='{$id_nota_entrada}' and artigo_armazem.id_artigo='{$id_artigo}'");
        $this->Resultado = $Visualizar->getResultado();
        $this->RowCount = $Visualizar->getRowCount();
        return $this->Resultado;
    }

}
