<div class="box">
    <header class="dark" style="">
        <div class="icons"><i class="icon-plus-sign"></i></div>
        <div class="toolbar">
            <ul class="nav">
                <li>
                    <div class="btn-group">
                        <a class="accordion-toggle btn btn-xs minimize-box" 
                           href="#" data-dismiss="modal">
                            <i class="icon-remove"></i> 
                        </a>

                    </div>
                </li>
            </ul>
        </div>
        <h6> &nbsp;&nbsp;Registar Artigo</h6>
    </header>
    <div id="collapse2" class="body collapse in">

        <?php
        if (isset($_SESSION['msg'])):
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        endif;
        if (isset($_SESSION['msgcad'])):
            echo $_SESSION['msgcad'];
            unset($_SESSION['msgcad']);
        endif;
        //var_dump($this->Dados);
        if (isset($this->Dados)):
            $valorForm = $this->Dados;
        elseif (isset($this->Dados[0])) :
            $valorForm = $this->Dados[0];
        endif;
        ?>
        <form name="basic-form" id="basic-form" action="" method="post" enctype="multipart/form-data" novalidate>
            <div class="form-group row">
                <label for="cod" class="col-sm-3 col-form-label">Código</label>
                <div class="col-sm-9">
                    <input type="text"  id="cod" class="form-control" name="cod" placeholder="Código do artigo" value="<?php
                    if (isset($valorForm['cod'])): echo $valorForm['cod'];
                    endif;
                    ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="nome" class="col-sm-3 col-form-label">Nome</label>
                <div class="col-sm-9">
                    <input type="text"  id="nome" class="form-control" name="nome" placeholder="Nome do artigo" value="<?php
                    if (isset($valorForm['nome'])): echo $valorForm['nome'];
                    endif;
                    ?>" required>
                </div>
            </div>

            <input type="hidden" name="created" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input type="hidden" name="empresa_id" value="<?php echo $_SESSION['id_empresa']; ?>">
            <input type="hidden" name="basic-form" value="Dados">

            <div class="form-group row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <button type="button" id='refresh' class="btn btn-primary btn-block" onclick="enviarDados('<?php echo URL; ?>controle-artigo/cadastrar/', 'basic-form')" value="REGISTAR" name="basic-form">REGISTAR</button>
                </div>
            </div>
        </form>
    </div>
</div>
