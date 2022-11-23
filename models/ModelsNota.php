<?php

/**
 * Descricao de ModelsArtigo
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ModelsNota {

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
        $Create->ExeCreate('nota_recepcao', $this->Dados);
        //var_dump($Create);        die();
        if ($Create->getResultado()):
            $this->Resultado = $Create->getResultado();
        endif;
    }

  
    public function apagar($ArtigoId) {
        $this->ArtigoId = (int) $ArtigoId;
        $this->Dados = $this->visualizar($this->ArtigoId);
        if ($this->getRowCount() >= 0):
            $ApagarArtigo = new ModelsDelete();
            $ApagarArtigo->ExeDelete('nota_recepcao', 'WHERE id =:id', "id={$this->ArtigoId}");
            $this->Resultado = $ApagarArtigo->getResultado();
            $_SESSION['msg'] = "<div class='alert alert-success'>Nota apagada com sucesso!</div>";
        else:
            $_SESSION['msg'] = "<div class='alert alert-success'>Nota não foi apagada com sucesso!</div>";
        endif;
    }

}
