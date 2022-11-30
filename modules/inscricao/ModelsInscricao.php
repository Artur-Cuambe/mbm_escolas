<?php

/**
 * Descricao de ModelsArtigo
 *
 * @copyright (c) 2022, Artur Cuambe
 */
class ModelsInscricao {

    private $Resultado;
    private $inscricaoId;
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
        $Paginacao = new ModelsPaginacao(URL . 'controle-inscricao/index/');
        $Paginacao->condicao($PageId, 1000);
        $this->ResultadoPaginacao = $Paginacao->paginacao($this->getQueryInscricao());
        // var_dump($Paginacao->getLimiteResultado());
        $Listar = new ModelsRead();
        $Listar->fullRead("{$this->getQueryInscricao()} LIMIT   {$Paginacao->getOffset()}, {$Paginacao->getLimiteResultado()}");
        //var_dump($Listar->getResultado());
        if ($Listar->getResultado()):
            $this->Resultado = $Listar->getResultado();
            return array($this->Resultado, $this->ResultadoPaginacao);
        else:
            // $Paginacao->paginaInvalida();
        endif;
    }

    public function visualizar($inscricaoId) {
        $this->inscricaoId = (int) $inscricaoId;
        $Visualizar = new ModelsRead();
        $Visualizar->fullRead("{$this->getQueryInscricao()} and idinscricao={$this->inscricaoId} limit 1");
        // var_dump("{$this->getQueryInscricao()} where idinscricao={$this->inscricaoId} limit 1");
        $this->Resultado = $Visualizar->getResultado();
        $this->RowCount = $Visualizar->getRowCount();
        return $this->Resultado;
    }

    public function listarCadastrar() {
        $query_estusante = new ModelsEstudante();
        $Listar = new ModelsRead();
        $Listar->ExeRead('turma');
        $turma = $Listar->getResultado();
        $Listar->ExeRead('periodo');
        $periodo = $Listar->getResultado();
        $Listar->ExeRead('curso');
        $curso = $Listar->getResultado();
        $Listar->fullRead("{$query_estusante->getQueryEsctudante()}");
        $estudante = $Listar->getResultado();
        $this->Resultado = array($turma,$periodo,$curso,$estudante);
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
        $Create->ExeCreate('inscricao', $this->Dados);
        $this->Msg = $Create->getMsg();
        if ($Create->getMsg()===NULL):
            $this->Resultado = $Create->getResultado();
        endif;
    }

    public function editar($AritgoId, array $Dados) {
        $this->inscricaoId = (int) $AritgoId;
        $this->Dados = $Dados;
        $this->inscricaoId = $this->Dados['idinscricao'];

        $this->validarDados();
        if ($this->Resultado):
            $this->alterar();

        endif;
    }

    private function alterar() {
        $Update = new ModelsUpdate();
        $Update->ExeUpdate('inscricao', $this->Dados, "WHERE idinscricao = :idinscricao", "idinscricao={$this->inscricaoId}");
        if ($Update->getResultado()):
            $this->Resultado = true;
        else:
            $this->Resultado = false;
        endif;
    }

    public function apagar($inscricaoId) {
        $this->inscricaoId = (int) $inscricaoId;
        $this->Dados = $this->visualizar($this->inscricaoId);
        if ($this->getRowCount() >= 0):
            $ApagarArtigo = new ModelsDelete();
            $ApagarArtigo->ExeDelete('inscricao', 'WHERE idinscricao =:idinscricao', "idinscricao={$this->inscricaoId}");
            $this->Resultado = $ApagarArtigo->getResultado();
            $_SESSION['msg'] = "<div class='alert alert-success'>Inscrição apagado com sucesso!</div>";
        else:
            $_SESSION['msg'] = "<div class='alert alert-success'>Inscrição não foi apagado com sucesso!</div>";
        endif;
    }

    private function getQueryInscricao(){
        return "SELECT
        inscricao.processo,
        curso.nome AS curso,
        turma.nome AS turma,
        periodo.nome AS periodo,
        estudante.nome,
        estudante.genero,
        turma.idturma,
        periodo.idperiodo,
        estudante.idestudante,
        curso.idcurso,
        inscricao.idinscricao,
        inscricao.turma_idturma,
        inscricao.periodo_idperiodo,
        inscricao.curso_idcurso,
        inscricao.estudante_idestudante,
        inscricao.created,
        inscricao.ano,
        departamento.descricao,
        curso.departamento_id
        FROM
        inscricao
        INNER JOIN turma ON inscricao.turma_idturma = turma.idturma
        INNER JOIN periodo ON inscricao.periodo_idperiodo = periodo.idperiodo
        INNER JOIN estudante ON inscricao.estudante_idestudante = estudante.idestudante
        INNER JOIN curso ON inscricao.curso_idcurso = curso.idcurso 
        INNER JOIN departamento ON curso.departamento_id = departamento.id  where inscricao.empresa_id = {$_SESSION['id_empresa']}";
    }

}