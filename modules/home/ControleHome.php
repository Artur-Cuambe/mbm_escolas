<?php

/**
 * Descricao de ControleHome
 *
 * @copyright (c) 2022, Artur Cuambe
 */
class ControleHome {
    
    private $Menu;

    public function index() {
        $ListarMenu = new ModelsMenu();
        $this->Menu = $ListarMenu->listar();
        
        $CarregarView = new ConfigView("home/views/home", $this->Menu);
        $CarregarView->renderizarListar();
    }
}
