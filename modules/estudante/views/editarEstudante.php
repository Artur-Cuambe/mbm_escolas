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
            unset($_SESSION['msg']);
        endif;

        // var_dump($this->Dados[1]);
        if (isset($this->Dados[0][0][0])):
            $valorForm = $this->Dados[0][0][0];
            $valorForm['data_nascimento'] = date('Y-m-d', strtotime($valorForm['data_nascimento']));
            $valorForm['data_emissao'] = date('Y-m-d', strtotime($valorForm['data_emissao']));
// var_dump($valorForm);
        elseif (isset($this->Dados[0])):
            $valorForm = $this->Dados[0];
            $valorForm['data_nascimento'] = date('Y-m-d', strtotime($valorForm['data_nascimento']));
            $valorForm['data_emissao'] = date('Y-m-d', strtotime($valorForm['data_emissao']));
// var_dump($valorForm);
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
                <label for="data_nascimento" class="col-sm-3 col-form-label">Data de nascimento</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control"  id="data_nascimento" name="data_nascimento" value="<?php
                    if (isset($valorForm['data_nascimento'])): echo $valorForm['data_nascimento'];
                    endif;
                    ?>"/>
                </div>
            </div>

            <div class="form-group row">
                <label for="documento" class="col-sm-3 col-form-label">Documento</label>
                <div class="col-sm-9">
                    <select name="documento" id="documento"  class="form-control">
                    <option value="<?php
                    if (isset($valorForm['documento'])): echo $valorForm['documento'];
                    endif;
                    ?>"><?php
                    if (isset($valorForm['documento'])): echo $valorForm['documento'];
                    endif;
                    ?></option>
                        <option value="BI">BI</option>
                        <option value="Passaporte">Passaporte</option>
                        <option value="Cédula">Cédula</option>
                        <option value="Certidão de nascimento">Certidão de nascimento</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="numero_documento" class="col-sm-3 col-form-label">Número do documento</label>
                <div class="col-sm-9">
                    <input type="text" id="numero_documento" class="form-control" name="numero_documento"
                        placeholder="Número do documento" value="<?php
                    if (isset($valorForm['numero_documento'])): echo $valorForm['numero_documento'];
                    endif;
                    ?>" >
                </div>
            </div>

            <div class="form-group row">
                <label for="local_emissao" class="col-sm-3 col-form-label">Local de emissão</label>
                <div class="col-sm-9">
                    <input type="text" id="local_emissao" class="form-control" name="local_emissao"
                        placeholder="Local de emissão do documento" value="<?php
                    if (isset($valorForm['local_emissao'])): echo $valorForm['local_emissao'];
                    endif;
                    ?>" >
                </div>
            </div>

            <div class="form-group row">
                <label for="data_emissao" class="col-sm-3 col-form-label">Data da emissão</label>
                <div class="col-sm-9">
                    <input type="date" class="form-control"  id="data_emissao" name="data_emissao" placeholder="Data da emissão do documento"  value="<?php
                    if (isset($valorForm['data_emissao'])): echo $valorForm['data_emissao'];
                    endif;
                    ?>"/>
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