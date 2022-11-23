<?php

/**
 * Descricao de ConfigView
 *
 * @copyright (c) year, Cesar Szpak - Celke
 */
class ConfigView {

    private $Nome;
    private $Dados;
    private $Menu;

    public function __construct($Nome, array $Menu = null, array $Dados = null) {
        $this->Nome = (string) $Nome;
        $this->Dados = $Dados;
        $this->Menu = $Menu;
    }
    
    public function renderizarForm() {
        include 'views/include/header.php';
        include 'views/include/menu.php';
        if (file_exists('views/' . $this->Nome . '.php')):
            include 'views/' . $this->Nome . '.php';
        else:
            echo "Erro ao carregar a VIEW: {$this->Nome}";
        endif;
        include 'views/include/footer.php';
    }

    public function renderizarlogin() {
        if (file_exists('views/' . $this->Nome . '.php')):
            include 'views/' . $this->Nome . '.php';
        endif;
    }

    public function renderizarHome() {
        include 'views/include/home/header.php';
        include 'views/include/menu.php';
        if (file_exists('views/' . $this->Nome . '.php')):
            include 'views/' . $this->Nome . '.php';
        else:
            echo "Erro ao carregar a VIEW: {$this->Nome}";
        endif;
        include 'views/include/home/footer.php';
    }

    public function renderizarListar() {
        include 'views/include/listar/header.php';
        include 'views/include/menu.php';
        if (file_exists('views/' . $this->Nome . '.php')):
            include 'views/' . $this->Nome . '.php';
        else:
            echo "Erro ao carregar a VIEW: {$this->Nome}";
        endif;
        include 'views/include/listar/footer.php';
    }

    public function getdados() {
        return $this->Dados;
    }

}
