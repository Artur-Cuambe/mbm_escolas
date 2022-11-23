<div class="box">
    <header class="dark" style="">
        <div class="icons"><i class="icon-edit-sign"></i></div>
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
        <h6> &nbsp;&nbsp;Editar Estudante</h6>
    </header>
    <div idestudante="collapse2" class="body collapse in">
        <?php
        if (isset($_SESSION['msg'])):
            echo $_SESSION['msg'];
        //     unset($_SESSION['msg']);
        endif;

        // var_dump($this->Dados[1]);
        if (isset($this->Dados[0][0][0])):
            $valorForm = $this->Dados[0][0][0];
//var_dump($valorForm);
        elseif (isset($this->Dados[0])):
            $valorForm = $this->Dados[0];
//var_dump($valorForm);
        endif;

        if (isset($this->Dados[0][2])):
            $provincias = $this->Dados[0][2];
        elseif (isset($this->Dados[1][2])):
            $provincias = $this->Dados[1][2];
//var_dump($provincias);
        endif;
        if (isset($this->Dados[0][1][0])):
            $enderecoCompleto = $this->Dados[0][1][0];
        elseif (isset($this->Dados[1][1][0])):
            $enderecoCompleto = $this->Dados[1][1][0];
        //var_dump($enderecoCompleto);
        endif;
        ?>
        <form name="CadFaculdade" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="idestudante" value="<?php
            if (isset($valorForm['idestudante'])):
                echo $valorForm['idestudante'];
            endif;
            ?>">

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
                        <option value="<?php
                    if (isset($valorForm['genero'])): echo $valorForm['genero'];
                    endif;
                    ?>"><?php
                    if (isset($valorForm['genero'])): echo $valorForm['genero'];
                    endif;
                    ?></option>
                        <option value="Feminino">Feminino</option>
                        <option value="Masculino">Masculino</option>
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
                    ?>" >
                </div>
            </div>

    
            <input type="hidden" name="modified" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input type="hidden" name="basic-form" value="Dados">

            <div class="form-group row">
                  <div class="col-sm-6"></div>
                <div class="col-sm-4">
                    <input type="button" class="btn btn-primary btn-block" value="REGISTAR" onclick="enviarDadosFile('<?php echo URL; ?>controle-estudante/editar/<?php echo $valorForm['idestudante']; ?>', 'basic-form')" name="basic-form">
                </div>
            </div>
        </form>
        <?php
//var_dump($this->Dados);
        ?>
    </div>
</div>