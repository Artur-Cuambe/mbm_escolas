<?php

/**
 * Descricao de ModelsPaginacao
 *
 * @copyright (c) 2022, Artur Cuambe
 */
class ModelsPaginacao {

    private $Link;
    private $MaxLinks;
    private $Pagina;
    private $LimiteResultado;
    private $Offset;
    private $Tabela;
    private $Termos;
    private $ParseString;
    private $Rows;
    private $ResultadoPaginacao;
    
    function getPagina() {
        return $this->Pagina;
    }

    function getLimiteResultado() {
        return $this->LimiteResultado;
    }

    function getOffset() {
        return $this->Offset;
    }

    function getResultadoPaginacao() {
        return $this->ResultadoPaginacao;
    }

    function __construct($Link) {
        $this->Link = $Link;
        $this->MaxLinks = 2;
        // echo "Link da página {$this->Link}<br>";
    }

    public function condicao($Pagina, $LimiteResultado) {
        $this->Pagina = ((int) $Pagina ? $Pagina : 1);
        $this->LimiteResultado = (int) $LimiteResultado;
        $this->Offset = ($this->Pagina * $this->LimiteResultado) - $this->LimiteResultado;
//        echo "Pagina Atual {$this->Pagina}<br>";
//        echo "Limite de resultado {$this->LimiteResultado}<br>";
//        echo "Offset {$this->Offset}<br>";
    }
    
    public function paginaInvalida() {
        header("Location: {$this->Link}");
    }

    public function paginacao($Tabela, $Termos = null, $ParseString = null) {
        $this->Tabela = (string) $Tabela;
        $this->Termos = (string) $Termos;
        $this->ParseString = (string) $ParseString;
        $this->intrucao();
        return $this->ResultadoPaginacao;
    }

    //criar a  paginacao de resultado
    private function intrucao() {
        $Listar = new ModelsRead();
        $Listar->fullRead($this->Tabela, $this->Termos, $this->ParseString);
        $this->Rows = $Listar->getRowCount();
        if ($this->Rows > $this->LimiteResultado):
            $this->intrucaoPaginacao();
        endif;
    }

    private function intrucaoPaginacao() {
        //echo "Quantidade de linhas {$this->Rows}<br>";
        $Paginas = ceil($this->Rows / $this->LimiteResultado);
        
        $this->validaQntLink($Paginas);
        //echo "Quantidade de paginas: {$Paginas}<br>";
        $this->ResultadoPaginacao = "<nav class='text-center'>";
        $this->ResultadoPaginacao .= "<ul class='pagination'>";
        $this->ResultadoPaginacao .= "<li><a onclick=\"enviaDados('{$this->Link}1',null,'content')\" >Primeira</a></li>";
        
        for($iPag = $this->Pagina - $this->MaxLinks; $iPag <= $this->Pagina - 1 ; $iPag ++):
            if($iPag >= 1):
                $this->ResultadoPaginacao .= "<li><a onclick=\"enviaDados('{$this->Link}{$iPag}',null,'content')\" >{$iPag}</a></li>";
            endif;
        endfor;
            
        $this->ResultadoPaginacao .= "<li class='active'><a >{$this->Pagina}</a></li>";
        
        for($dPag = $this->Pagina + 1; $dPag <= $this->Pagina + $this->MaxLinks; $dPag ++):
            if($dPag <= $Paginas):
                $this->ResultadoPaginacao .= "<li><a onclick=\"enviaDados('{$this->Link}{$dPag}',null,'content')\" >{$dPag}</a></li>";
            endif;
        endfor;

        $this->ResultadoPaginacao .= "<li><a onclick=\"enviaDados('{$this->Link}{$Paginas}',null,'content')\" >Última</a></li>";
        $this->ResultadoPaginacao .= "</ul></nav>";
        
        //echo $this->ResultadoPaginacao;
    }
    
    private function validaQntLink($Paginas) {
        if(($this->Pagina == 1) || ($this->Pagina == $Paginas)):
            $this->MaxLinks = 4;
        elseif(($this->Pagina == 2) || ($this->Pagina == $Paginas - 1)):
            $this->MaxLinks = 3;
        endif;
    }

}
