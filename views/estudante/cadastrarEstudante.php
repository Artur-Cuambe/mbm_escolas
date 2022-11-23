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
        <h6> &nbsp;&nbsp;Registar Estudante</h6>
    </header>
    <div id="collapse2" class="body collapse in">

        <?php
        if (isset($_SESSION['msg'])):
            echo $_SESSION['msg'];
            //unset($_SESSION['msg']);
        endif;

        if (isset($this->Dados[0])):
            $valorForm = $this->Dados[0];
        //var_dump($valorForm);
        endif;
        if (isset($this->Dados[1])):
            $provincias = $this->Dados[1];
        //var_dump($provincias);
        endif;
        ?>
        <form name="CadEmpresa" class="form-horizontal" action="" method="post" enctype="multipart/form-data">

            <div class="form-group row">
                <label for="nome" class="col-sm-3 col-form-label">Nome</label>
                <div class="col-sm-9">
                    <input type="text"  id="nome" class="form-control" name="nome" placeholder="Nome do estudante" value="<?php
                    if (isset($valorForm['nome'])): echo $valorForm['nome'];
                    endif;
                    ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="genero" class="col-sm-3 col-form-label">Gênero</label>
                <div class="col-sm-9">
                    <select name="genero" id="genero" required class="form-control" >
                        <option >Selecione o gênero</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="residencia" class="col-sm-3 col-form-label">Endereço</label>
                <div class="col-sm-9">
                <input type="text"  id="residencia" class="form-control" name="residencia" placeholder="Endereço do estudante" value="<?php
                    if (isset($valorForm['residencia'])): echo $valorForm['residencia'];
                    endif;
                    ?>" required>
                </div>
            </div>
        
            <div class="form-group row">
                <label for="telefone" class="col-sm-3 col-form-label">Telefone</label>
                <div class="col-sm-9">
                    <input type="text"  id="telefone" class="form-control" name="telefone" placeholder="Telefone da Faculdade" value="<?php
                    if (isset($valorForm['telefone'])): echo $valorForm['telefone'];
                    endif;
                    ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">E-mail:</label>
                <div class="col-sm-9">
                    <input type="text"  id="email" class="form-control" name="email" placeholder="E-mail da Faculdade" value="<?php
                    if (isset($valorForm['email'])): echo $valorForm['email'];
                    endif;
                    ?>">
                </div>
            </div>

            <input type="hidden" name="created" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input type="hidden" name="empresa_id" value="<?php echo $_SESSION['id_empresa']; ?>">
            <input type="hidden" name="basic-form" value="Dados">

            <div class="form-group row">
                <div class="col-sm-6"></div>
                <div class="col-sm-4">
                    <input type="button" class="btn btn-primary btn-block" value="REGISTAR" onclick="enviarDadosFile('<?php echo URL; ?>controle-estudante/cadastrar', 'basic-form')" name="basic-form">
                </div>
            </div>
        </form>
        <?php
//var_dump($this->Dados);
        ?>
    </div>
</div>