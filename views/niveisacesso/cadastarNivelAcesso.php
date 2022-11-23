
<?php
if (isset($this->Dados[1])):
    $departamentos = $this->Dados[1];
//        var_dump($departamentos);
endif;
if (isset($this->Dados[0][0])):
    $valorForm = $this->Dados[0][0];
//        var_dump($valorForm);
elseif (isset($this->Dados[0])):
    $valorForm = $this->Dados[0];
//        var_dump($valorForm);
endif;
?>
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
        <h6> &nbsp;&nbsp;Editar  Nivel de Acesso</h6>
    </header>
    <div id="collapse2" class="body collapse in">

        <form  name="basic-form" id="basic-form" class="form-horizontal"  method="post" enctype="multipart/form-data" >
            <div style="text-align: center;">   <?php
                if (isset($_SESSION['msg'])):
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                endif;
                ?>
            </div>
           
            <div class="form-group">
                <label class="control-label col-lg-4">Designação <i style="color: red;">*</i></label>
                <div class="col-lg-6">
                    <input type="text"  class="validate[required] form-control" name="nome_niveis_acesso" placeholder="Nome do Nivel de Acesso" value="<?php
                    if (isset($valorForm['nome_niveis_acesso'])):
                        echo $valorForm['nome_niveis_acesso'];
                    endif;
                    ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4">Descrição <i style="color: red;">*</i></label>
                <div class="col-lg-6">
                    <textarea class="validate[required] form-control" name="descricao" id="descricao" placeholder="Descreva o Nivel de Acesso em poucas palavras"><?php
                        if (isset($valorForm['descricao'])):
                            echo $valorForm['descricao'];
                        endif;
                        ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-4">Laboratório <i style="color: red;">*</i></label>
                <div class="col-lg-6">
                    <select class="form-control select-basic " name="departamento_id" id="departamento_id" required style="width: 100%;">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($departamentos as $departamento):
                            extract($departamento);
                            if ($valorForm['departamento_id'] == $id):
                                $selecionado = "selected";
                            else:
                                $selecionado = "";
                            endif;
                            echo "<option value='$id' $selecionado>$descricao</option>";
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <input type="hidden" name="created" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input type="hidden" name="basic-form" value="Dados">
            <div style="text-align:center" class="form-actions no-margin-bottom">
                <button type="button" id='refresh' class="btn btn-primary btn-block" onclick="enviarDados('<?php echo URL; ?>controle-niveis-acesso/cadastrar/', 'basic-form')" value="REGISTAR" name="basic-form">REGISTAR</button>
            </div>
        </form>
    </div>
</div>