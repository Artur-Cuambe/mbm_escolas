<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControleBusca
 *
 * @author logan Cuambe
 */
class ControleBusca {

    private $Dados;

    public function buscaDistrito() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $Listar = new ModelsBusca();
        $this->Dados = $Listar->listarDistrito($this->Dados['id']);
        $CarregarView = new ConfigView("endereco/distrito", NULL, $this->Dados);
        $CarregarView->renderizarlogin();
    }

    public function buscaPosto() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $Listar = new ModelsBusca();
        $this->Dados = $Listar->listarPosto($this->Dados['id']);
        $CarregarView = new ConfigView("endereco/posto", NULL, $this->Dados);
        $CarregarView->renderizarlogin();
    }

    public function buscaLocal() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $Listar = new ModelsBusca();
        $this->Dados = $Listar->listarLocal($this->Dados['id']);
        $CarregarView = new ConfigView("endereco/local", NULL, $this->Dados);
        $CarregarView->renderizarlogin();
    }

    public function buscaBairro() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $Listar = new ModelsBusca();
        $this->Dados = $Listar->listarBairro($this->Dados['id']);
        $CarregarView = new ConfigView("endereco/bairro", NULL, $this->Dados);
        $CarregarView->renderizarlogin();
    }

    public function buscaQuart() {
        $this->Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $Listar = new ModelsBusca();
        $this->Dados = $Listar->listarQuart($this->Dados['id']);
        $CarregarView = new ConfigView("endereco/quart", NULL, $this->Dados);
        $CarregarView->renderizarlogin();
    }

}
