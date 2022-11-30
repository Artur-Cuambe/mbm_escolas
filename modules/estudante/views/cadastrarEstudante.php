<div class="box">
    <header class="dark" style="">
        <div class="icons"><i class="icon-plus-sign"></i></div>
        <div class="toolbar">
            <ul class="nav">
                <li>
                    <div class="btn-group">
                        <a class="accordion-toggle btn btn-xs minimize-box" href="#" data-dismiss="modal">
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
            unset($_SESSION['msg']);
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
                    <input type="text" id="nome" class="form-control" name="nome" required placeholder="Nome do estudante" value="<?php
                    if (isset($valorForm['nome'])): echo $valorForm['nome'];
                    endif;
                    ?>" >
                </div>
            </div>

            <div class="form-group row">
                <label for="genero" class="col-sm-3 col-form-label">Gênero</label>
                <div class="col-sm-9">
                    <select name="genero" id="genero"  class="form-control">
                        <option>Selecione o gênero</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
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
                        <option>Selecione o tipo de Documento</option>
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
                    <input type="text" id="residencia" class="form-control" name="residencia"
                        placeholder="Endereço do estudante" value="<?php
                    if (isset($valorForm['residencia'])): echo $valorForm['residencia'];
                    endif;
                    ?>" >
                </div>
            </div>

            <div class="form-group row">
                <label for="telefone" class="col-sm-3 col-form-label">Telefone</label>
                <div class="col-sm-9">
                    <input type="text" id="telefone" class="form-control" name="telefone"
                        placeholder="Telefone do estudante" value="<?php
                    if (isset($valorForm['telefone'])): echo $valorForm['telefone'];
                    endif;
                    ?>" >
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">E-mail:</label>
                <div class="col-sm-9">
                    <input type="text" id="email" class="form-control" name="email" placeholder="E-mail do estudante"
                        value="<?php
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
                    <input type="button" class="btn btn-primary btn-block" value="Próximo"
                        onclick="enviarDadosFile('<?php echo URL; ?>controle-estudante/cadastrar', 'basic-form')"
                        name="basic-form">
                </div>
            </div>
        </form>
        <?php
//var_dump($this->Dados);
        ?>
    </div>
</div>