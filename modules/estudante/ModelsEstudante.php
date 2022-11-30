<?php
/**
 * Descricao de ModelsEstudante
 *
 * @copyright (c) 2022, Artur Cuambe - 
 */
class ModelsEstudante {

    private $Resultado;
    private $EstudanteId;
    private $Dados;
    private $Msg;
    private $RowCount;

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
        $Paginacao = new ModelsPaginacao(URL . 'controle-estudante/index/');
        $Paginacao->condicao($PageId, 1000);
        $this->ResultadoPaginacao = $Paginacao->paginacao($this->getQueryEsctudante());
        // var_dump($this->ResultadoPaginacao);
        // die;
        $Listar = new ModelsRead();
        $Listar->fullRead("{$this->getQueryEsctudante()} ORDER BY estudante.idestudante desc LIMIT   {$Paginacao->getOffset()}, {$Paginacao->getLimiteResultado()} ");
        // var_dump($Listar->getResultado());
        // die;
        if ($Listar->getResultado()):
            $this->Resultado = $Listar->getResultado();
            return array($this->Resultado, $this->ResultadoPaginacao);
        else:
            // $Paginacao->paginaInvalida();
        endif;
    }
    // public function listar() {
    //     $Listar = new ModelsRead();
    //     $Listar->ExeRead('estudante');
    //     $this->Resultado = $Listar->getResultado();
    //     //var_dump($this->Resultado);
    //     return $this->Resultado;
    // }

    public function cadastrar(array $Dados) {
        $this->Dados = $Dados;
        $this->validarDados();
        //var_dump($this->Dados);
        if ($this->Resultado):
            $this->inserir();
        endif;
    }

    private function inserir() {
        $Create = new ModelsCreate;
        $Create->ExeCreate('estudante', $this->Dados);
        $this->Msg = $Create->getMsg();
        if ($Create->getMsg()===NULL):
            $this->Resultado = $Create->getResultado();
        endif;
    }

    private function validarDados() {
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
        if (in_array('', $this->Dados)):
            $this->Resultado = false;
        else:
            $this->Resultado = true;
        endif;
    }

    public function visualizar($EstudanteId) {
        $this->EstudanteId = (int) $EstudanteId;
        $Visualizar = new ModelsRead();
        $Visualizar->ExeRead('estudante', 'WHERE idestudante =:idestudante LIMIT :limit', "idestudante={$this->EstudanteId}&limit=1");
        $this->Resultado = $Visualizar->getResultado();
        $this->RowCount = $Visualizar->getRowCount();
        // $resultado = $this->listarEditar($this->Resultado[0]['quarteirao_id']);
        $this->Resultado = array($Visualizar->getResultado());
        return $this->Resultado;
    }

    public function editar($EstudanteId, array $Dados) {
        $this->EstudanteId = (int) $EstudanteId;
        $this->Dados = $Dados;
        $this->EstudanteId = $this->Dados['idestudante'];
        $this->validarDados();
        if ($this->Resultado):
            $this->alterar();
        endif;
    }

    private function alterar() {
        $Update = new ModelsUpdate();
        $Update->ExeUpdate('estudante', $this->Dados, "WHERE idestudante = :idestudante", "idestudante={$this->EstudanteId }");
        if ($Update->getResultado()):
            $this->Resultado = true;
        else:
            $this->Resultado = false;
        endif;
    }

    public function apagar($EstudanteId) {
        $this->EstudanteId = (int) $EstudanteId;
        $this->Dados = $this->visualizar($this->EstudanteId);
        if ($this->getRowCount() >= 0):
            $ApagarEstudante = new ModelsDelete();
            $ApagarEstudante->ExeDelete('estudante', 'WHERE idestudante =:idestudante', "idestudante={$this->EstudanteId}");
            $_SESSION['msg'] = "<div class='alert alert-success'>Estudante apagada com sucesso!</div>";
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Estudante não foi apagada com sucesso!</div>";
        endif;
    }

    public function listarCadastrar() {
        $Listar = new ModelsRead();
        $Listar->ExeRead('provincias');
        $this->Resultado = $Listar->getResultado();
        //var_dump($this->Resultado);
        return $this->Resultado;
    }

    public function listarEditar($id) {
        $id = (int) $id;
        $Listar = new ModelsRead();
        $Listar->ExeRead('provincias');
        $provincias = $Listar->getResultado();

        $Listar->fullRead("SELECT
                                povoado_aldeia_zona_unidade.nome as quarteirao,
                                bairros.nome as bairro,
                                localidades.nome as localidade,
                                postos.nome as posto,
                                distritos.nome as distrito,
                                provincias.id,
                                provincias.nome as provincia,
                                povoado_aldeia_zona_unidade.id as quarteirao_id
                                FROM
                                povoado_aldeia_zona_unidade
                                INNER JOIN bairros ON povoado_aldeia_zona_unidade.bairro_id = bairros.id
                                INNER JOIN localidades ON bairros.localidade_id = localidades.id
                                INNER JOIN postos ON localidades.posto_id = postos.id
                                INNER JOIN distritos ON postos.distrito_id = distritos.id
                                INNER JOIN provincias ON distritos.provincia_id = provincias.id WHERE povoado_aldeia_zona_unidade.id = {$id}");
        $enderecoCompleto = $Listar->getResultado();

        $this->Resultado = array($provincias, $enderecoCompleto);
        return $this->Resultado;
    }

    public function getQueryEsctudante(){
       return "SELECT
                estudante.idestudante,
                estudante.nome,
                estudante.genero,
                estudante.data_nascimento,
                estudante.documento,
                estudante.numero_documento,
                estudante.local_emissao,
                estudante.data_emissao,
                estudante.residencia,
                estudante.email,
                estudante.telefone,
                estudante.estado_inscricao,
                estudante.created,
                estudante.modified
            FROM
                estudante  where empresa_id = {$_SESSION['id_empresa']}";
    }

}
