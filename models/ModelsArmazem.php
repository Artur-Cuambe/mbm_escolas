<?php

/**
 * Descricao de ModelsArtigo
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ModelsArmazem {

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
        $Paginacao = new ModelsPaginacao(URL . 'controle-departamento/index/');
        $Paginacao->condicao($PageId, 20);
        $this->ResultadoPaginacao = $Paginacao->paginacao('SELECT
armazem.id,
armazem.descricao,
armazem.created,
armazem.modified,
departamento.descricao as departamento
FROM
armazem
INNER JOIN departamento ON armazem.departamento_id = departamento.id');

        $Listar = new ModelsRead();
        $Listar->fullRead('SELECT
armazem.id,
armazem.descricao,
armazem.created,
armazem.modified,
departamento.descricao as departamento
FROM
armazem
INNER JOIN departamento ON armazem.departamento_id = departamento.id', "LIMIT :limit OFFSET :offset", "limit={$Paginacao->getLimiteResultado()}&offset={$Paginacao->getOffset()}");
        //var_dump($Listar->getResultado());
        if ($Listar->getResultado()):
            $this->Resultado = $Listar->getResultado();
            return array($this->Resultado, $this->ResultadoPaginacao);
        else:
            $Paginacao->paginaInvalida();
        endif;
    }

    public function visualizar($ArtigoId) {
        $this->ArtigoId = (int) $ArtigoId;
        $Visualizar = new ModelsRead();
        $Visualizar->ExeRead('armazem', "WHERE id =:id LIMIT :limit", "id={$this->ArtigoId}&limit=1");

        //var_dump($Visualizar->getResultado());
        $this->Resultado = $Visualizar->getResultado();
        $this->RowCount = $Visualizar->getRowCount();
        return $this->Resultado;
    }

    public function listarCadastrar() {
        $Listar = new ModelsRead();
        $Listar->ExeRead('departamento');
        $CatArtigos = $Listar->getResultado();
        $this->Resultado = array($CatArtigos);
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
        $Create->ExeCreate('armazem', $this->Dados);
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
        $Update->ExeUpdate('armazem', $this->Dados, "WHERE id = :id", "id={$this->ArtigoId }");
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
            $ApagarArtigo->ExeDelete('armazem', 'WHERE id =:id', "id={$this->ArtigoId}");
            $this->Resultado = $ApagarArtigo->getResultado();
            $_SESSION['msg'] = "<div class='alert alert-success'>Armazem apagado com sucesso!</div>";
        else:
            $_SESSION['msg'] = "<div class='alert alert-success'>Armazem não foi apagado com sucesso!</div>";
        endif;
    }

}
