<?php

/**
 * Descricao de ModelsUsuario
 *
 * @copyright (c) 2020, Artur Cuambe
 */
class ModelsUsuario {

    private $Resultado;
    private $UserId;
    private $Dados;
    private $Msg;
    private $RowCount;
    private $ResultadoPaginacao;
    private $Foto;

    const Entity = 'users';

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
        $Paginacao = new ModelsPaginacao(URL . 'controle-usuario/index/');
        $Paginacao->condicao($PageId, 10);
        $this->ResultadoPaginacao = $Paginacao->paginacao('users');

        $Listar = new ModelsRead();
        $Listar->fullRead("SELECT
        users.`name`,
        users.id,
        users.niveis_acesso_id,
        users.email,
        users.foto,
        users.estado,
        users.created,
        users.modified,
        niveis_acessos.nome_niveis_acesso
        FROM
        users
        INNER JOIN niveis_acessos ON users.niveis_acesso_id = niveis_acessos.id
        INNER JOIN departamento ON niveis_acessos.departamento_id = departamento.id
        WHERE empresa_id = {$_SESSION['id_empresa']}");
        if ($Listar->getResultado()):
            $this->Resultado = $Listar->getResultado();
            return array($this->Resultado, $this->ResultadoPaginacao);
        else:
            //echo "Nenhum usuário encontrado<br>";
            // $Paginacao->paginaInvalida();
        endif;
    }

   public function visualizar($UserId)
    {
        $this->UserId = (int) $UserId;
        $Visualizar = new ModelsRead();
        $Visualizar->fullRead("SELECT
                                users.id,
                                users.`name`,
                                users.`estado`,
                                users.email,
                                users.foto,
                                users.created,
                                users.modified,
                                situacoes_users.nome_sit_user AS situacao,
                                niveis_acessos.nome_niveis_acesso AS nivel,
                                users.niveis_acesso_id,
                                users.situacoes_user_id
                                FROM
                                users INNER JOIN situacoes_users on users.situacoes_user_id =situacoes_users.id 
                                INNER JOIN niveis_acessos on users.niveis_acesso_id= niveis_acessos.id WHERE    users.id = {$this->UserId}");
        $this->Resultado = $Visualizar->getResultado();
        $this->RowCount = $Visualizar->getRowCount();
        return $this->Resultado;
    }

    public function cadastrar(array $Dados) {
        $this->Dados = $Dados;
        $this->ValidarDados();
        if ($this->Resultado):
            if (empty($this->Foto['name'])):
                $this->inserir();
            else:
                $SlugImagem = new ModelsValidacao();
                $SlugImagem->nomeSlug($this->Foto['name']);
                $this->Foto['name'] = $SlugImagem->getNome();
                $this->Dados['foto'] = $this->Foto['name'];
                //var_dump($this->Dados);  
                $this->inserir();
                $UploadFoto = new ModelsUpload();
                $UploadFoto->upload($this->Foto, 'usuarios/' . $this->Resultado . '/', $this->Dados['foto']);

            endif;
        endif;
    }

    public function registar(array $Dados) {
        $this->Dados = $Dados;
        $this->validarRegiDados();
        if ($this->Resultado):
            $this->inserir();
        endif;
    }

    public function listarCadastrar() {
        $Listar = new ModelsRead();
        $Listar->fullRead("SELECT
        niveis_acessos.id,
        niveis_acessos.nome_niveis_acesso,
        departamento.empresa_id
        FROM
        niveis_acessos
        INNER JOIN departamento ON niveis_acessos.departamento_id = departamento.id WHERE empresa_id = {$_SESSION['id_empresa']}");
        $NivelAcesso = $Listar->getResultado();
        //var_dump($NivelAcesso);
        $Listar->ExeRead('situacoes_users');
        $SituacaoUsers = $Listar->getResultado();
        //var_dump($SituacaoUsers);
        $this->Resultado = array($NivelAcesso, $SituacaoUsers);
        //var_dump($this->Resultado);
        return $this->Resultado;
    }

    private function validarDados() {
        $this->Foto = $this->Dados['foto'];
        unset($this->Dados['foto']);
        //var_dump($this->Dados);
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
        if (in_array('', $this->Dados)):
            $this->Resultado = false;
        else:
            $this->Dados['password'] = md5($this->Dados['password']);
            $this->Resultado = true;
        endif;
    }

    private function validarRegiDados() {
        $this->Dados = array_map('strip_tags', $this->Dados);
        $this->Dados = array_map('trim', $this->Dados);
        if (in_array('', $this->Dados)):
            $this->Resultado = false;
        else:
            $this->Dados['password'] = md5($this->Dados['password']);
            $this->Resultado = true;
        endif;
    }

    private function inserir() {
        $Create = new ModelsCreate;
        $Create->ExeCreate(self::Entity, $this->Dados);
        if ($Create->getResultado()):
            $this->Resultado = $Create->getResultado();
        endif;
    }

    public function editar($UserId, array $Dados) {
        $this->UserId = (int) $UserId;
        $this->Dados = $Dados;
        $this->UserId = $this->Dados['id'];
        $foto_antiga = $this->Dados['foto_antiga'];
        unset($this->Dados['foto_antiga']);
        $this->validarDados();
        if ($this->Resultado):
            if (empty($this->Foto['name'])):
                $this->alterar();
            else:
                if (file_exists('assets/imagens/usuarios/' . $this->UserId . '/' . $foto_antiga)):
                    unlink('assets/imagens/usuarios/' . $this->UserId . '/' . $foto_antiga);
                endif;
                $SlugImagem = new ModelsValidacao();
                $SlugImagem->nomeSlug($this->Foto['name']);
                $this->Foto['name'] = $SlugImagem->getNome();
                $this->Dados['foto'] = $this->Foto['name'];
                $this->alterar();
                $UploadFoto = new ModelsUpload();
                $UploadFoto->upload($this->Foto, 'usuarios/' . $this->UserId . '/', $this->Dados['foto']);

            endif;
        endif;
    }

    private function alterar() {
        $Update = new ModelsUpdate();
        $Update->ExeUpdate(self::Entity, $this->Dados, "WHERE id = :id", "id={$this->UserId }");
        if ($Update->getResultado()):
            $this->Resultado = true;
        else:
            $this->Resultado = false;
        endif;
    }

    public function apagar($UserId) {
        $this->Dados = $this->visualizar($UserId);
       // var_dump($this->Dados);
        if ($this->getRowCount() > 0):
            //echo "<img src='" + URL + "assets/assets/images/loader.gif' width='50' height='50' alt='Carregando...'/>";
            $ApagarUsuario = new ModelsDelete();
            $ApagarUsuario->ExeDelete('users', 'WHERE id = :id', "id=$UserId");
            $this->Resultado = $ApagarUsuario->getResultado();
            $_SESSION['msg'] = "<div class='alert alert-success'>Usuário apagado com sucesso.</div>";
        else:
            $_SESSION['msg'] = "<div class='alert alert-danger'>Não foi encontrado o usuário.</div>";
        endif;
    }

    public function getProvedor($id) {
        $id = (int) $id;
        $Listar = new ModelsRead();
        $Listar->fullRead("SELECT
                                empresa.id,
                                empresa.nuit,
                                empresa.descricao
                            FROM
                                niveis_acessos
                            INNER JOIN departamento ON niveis_acessos.departamento_id = departamento.id
                            INNER JOIN empresa ON departamento.empresa_id = empresa.id
                            WHERE niveis_acessos.id = '$id'");
        $NivelAcesso = $Listar->getResultado();
        return $NivelAcesso;
    }

    public function atualizaSessao($UserId) {
        $this->UserId = (int) $UserId;
        $this->Dados = $this->visualizar($this->UserId);
        $provedor = $this->getProvedor($this->Dados[0]['niveis_acesso_id']);
        //var_dump($this->Dados);
        $_SESSION['id'] = $this->Dados[0]['id'];
        $_SESSION['name'] = $this->Dados[0]['name'];
        $_SESSION['email'] = $this->Dados[0]['email'];
        $_SESSION['foto'] = $this->Dados[0]['foto'];
        $_SESSION['niveis_acesso_id'] = $this->Dados[0]['niveis_acesso_id'];

        $_SESSION['nuit'] = $provedor[0]['nuit'];
        $_SESSION['nome_empresa'] = $provedor[0]['descricao'];
        $_SESSION['id_empresa'] = $provedor[0]['id'];
    }

}
