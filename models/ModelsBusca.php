<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ModelsBusca
 *
 * @author logan Cuambe
 */
class ModelsBusca {

    public function listarDistrito($id) {
        $Listar = new ModelsRead();
        $Listar->fullRead("SELECT distritos.nome, distritos.id FROM distritos WHERE distritos.provincia_id = '{$id}'");
        $distrito = $Listar->getResultado();
        //var_dump($NivelAcesso);
        $this->Resultado = $distrito;
        return $this->Resultado;
    }
    
    public function listarPosto($id) {
        $Listar = new ModelsRead();
        $Listar->fullRead("SELECT postos.nome, postos.id FROM postos WHERE postos.distrito_id = '{$id}'");
        $distrito = $Listar->getResultado();
        //var_dump($NivelAcesso);
        $this->Resultado = $distrito;
        return $this->Resultado;
    }
    public function listarLocal($id) {
        $Listar = new ModelsRead();
        $Listar->fullRead("SELECT localidades.nome, localidades.id FROM localidades WHERE localidades.posto_id = '{$id}'");
        $distrito = $Listar->getResultado();
        //var_dump($NivelAcesso);
        $this->Resultado = $distrito;
        return $this->Resultado;
    }
    public function listarBairro($id) {
        $Listar = new ModelsRead();
        $Listar->fullRead("SELECT bairros.nome, bairros.id FROM bairros WHERE bairros.localidade_id = '{$id}'");
        $distrito = $Listar->getResultado();
        //var_dump($NivelAcesso);
        $this->Resultado = $distrito;
        return $this->Resultado;
    }
    
    public function listarQuart($id) {
        $Listar = new ModelsRead();
        $Listar->fullRead("SELECT povoado_aldeia_zona_unidade.nome, povoado_aldeia_zona_unidade.id FROM povoado_aldeia_zona_unidade WHERE povoado_aldeia_zona_unidade.bairro_id = '{$id}'");
        $distrito = $Listar->getResultado();
        //var_dump($NivelAcesso);
        $this->Resultado = $distrito;
        return $this->Resultado;
    }
    public function listarQuarteirao() {
        $Listar = new ModelsRead();
        $Listar->fullRead("SELECT povoado_aldeia_zona_unidade.nome, povoado_aldeia_zona_unidade.id FROM povoado_aldeia_zona_unidade");
        $distrito = $Listar->getResultado();
        //var_dump($NivelAcesso);
        $this->Resultado = $distrito;
        return $this->Resultado;
    }

}
