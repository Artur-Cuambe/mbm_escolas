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
        <h6> &nbsp;&nbsp;Registar Faculdade</h6>
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
                <label for="nuit" class="col-sm-3 col-form-label">NUIT</label>
                <div class="col-sm-9">
                    <input type="text"  id="nuit" class="form-control" name="nuit" placeholder="NUIT da faculdade" value="<?php
                    if (isset($valorForm['nuit'])): echo $valorForm['nuit'];
                    endif;
                    ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="descricao" class="col-sm-3 col-form-label">Nome</label>
                <div class="col-sm-9">
                    <input type="text"  id="descricao" class="form-control" name="descricao" placeholder="Nome da faculdade" value="<?php
                    if (isset($valorForm['descricao'])): echo $valorForm['descricao'];
                    endif;
                    ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="telefone" class="col-sm-3 col-form-label">Endereço</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control text-left btn btn-dark" placeholder="Endereço da faculdade" id="meuInput" data-toggle="modal" data-target=".bd-example-modal-lg" readonly required>
                </div>
            </div>
            <div class="modal bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
                <div class="modal-dialog-centered" style="width: 50%">
                    <div class="modal-content"  >
                        <div class="modal-body">
                            <fieldset>
                                <legend>Endereço:</legend>
                                <div class="form-row">
                                    <div class="col-sm-12">
                                        <p> 
                                            <select class=" form-control" onchange="enviaDados('<?php echo URL; ?>/controle-busca/busca-distrito/', {id: this.value}, 'distrito')">
                                                <option value="">Selecione a Província</option>
                                                <?php
                                                foreach ($provincias as $provincia):
                                                    extract($provincia);
                                                    $nome = utf8_encode($nome);
                                                    echo "<option value='$id' $selecionado> $nome</option>";
                                                endforeach;
                                                ?>
                                            </select>
                                        </p>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-sm-12">
                                        <p id="distrito">  
                                            <select class=" form-control">
                                                <option value="">Selecione o Distrito</option>

                                            </select>
                                        </p>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-sm-12">
                                        <p id="posto">  
                                            <select class=" form-control">
                                                <option value="">Selecione o Posto Administrativo</option>
                                            </select>
                                        </p>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-sm-12">
                                        <p id="local">  <select class=" form-control">
                                                <option value="">Selecione a Localidade</option>
                                            </select>
                                        </p >
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-sm-12">
                                        <p id="bairro">
                                            <select class=" form-control">
                                                <option value="">Selecione o Bairro</option>
                                            </select>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-sm-12">
                                        <p id="quarteirao">  <select class=" form-control" name="quarteirao_id" >
                                                <option value="">Selecione o Quarteirão/Zona/Unidade/Povoado/Aldeia</option>
                                                <?php
                                                foreach ($quarteirao as $quarteira):
                                                    extract($quarteira);
                                                    if ($valorForm['quarteirao_id'] == $id):

                                                        $selecionado = 'selected';
                                                    else:
                                                        $selecionado = "";
                                                    endif;

                                                    echo "<option value='$id' $selecionado>$nome</option>";
                                                endforeach;
                                                ?>
                                            </select>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-sm-12">
                                        <p >  
                                            <input type="text"  class="form-control" name="avenida" placeholder="Avenida" value="<?php
                                            if (isset($valorForm['avenida'])): echo $valorForm['avenida'];
                                            endif;
                                            ?>">
                                        </p>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-sm-12">
                                        <p>  
                                            <input type="text"  class="form-control" name="rua" placeholder="Rua" value="<?php
                                            if (isset($valorForm['rua'])): echo $valorForm['rua'];
                                            endif;
                                            ?>">
                                        </p>
                                    </div>
                                </div>
                            </fieldset>
                        </div>

                    </div>
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

            <div class="form-group row">
                <label for="foto" class="col-sm-3 col-form-label">Logotipo/IMG:</label>
                <div class="col-sm-9">
                    <input type="file"  name="foto" id="foto"/>
                </div>
            </div>

            <input type="hidden" name="created" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input type="hidden" name="basic-form" value="Dados">

            <div class="form-group row">
                <div class="col-sm-6"></div>
                <div class="col-sm-4">
                    <input type="button" class="btn btn-primary btn-block" value="REGISTAR" onclick="enviarDadosFile('<?php echo URL; ?>controle-empresa/cadastrar', 'basic-form')" name="basic-form">
                </div>
            </div>
        </form>
        <?php
//var_dump($this->Dados);
        ?>
    </div>
</div>