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
        <h6> &nbsp;&nbsp;Editar Armazem</h6>
    </header>
    <div id="collapse2" class="body collapse in">
        <?php
        if (isset($this->Dados[0])):
            $departamentos = $this->Dados[0];
//var_dump($catArtigos);
        endif;
        if (isset($this->Dados[1][0])):
            $valorForm = $this->Dados[1][0];
//var_dump($valorForm);
        elseif (isset($this->Dados[1])):
            $valorForm = $this->Dados[1];
//var_dump($valorForm);
        endif;
        ?>

        <?php
        if (isset($_SESSION['msg'])):
            echo $_SESSION['msg'];
        //unset($_SESSION['msg']);
        endif;
        if (isset($_SESSION['msgcad'])):
            echo $_SESSION['msgcad'];
            unset($_SESSION['msgcad']);
        endif;
        ?>
        <form name="basic-form" id="basic-form" action="" method="post" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="id" value="<?php
            if (isset($valorForm['id'])):
                echo $valorForm['id'];
            endif;
            ?>">
            <div class="form-group row">
                <label for="descricao" class="col-sm-3 col-form-label">Descrição</label>
                <div class="col-sm-9">
                    <input type="text"  id="descricao" class="form-control" name="descricao" placeholder="Descrição" value="<?php
                    if (isset($valorForm['descricao'])): echo $valorForm['descricao'];
                    endif;
                    ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="departamento_id" class="col-sm-3 col-form-label">Laboratório</label>
                <div class="col-sm-9">
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
            <input type="hidden" name="modified" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input type="hidden" name="basic-form" value="Dados">

            <div class="form-group row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <input type="button" class="btn btn-primary btn-block" onclick="enviarDados('<?php echo URL; ?>controle-armazem/editar/<?php echo $valorForm['id']; ?>', 'basic-form')" value="SALVAR" name="basic-form">
                </div>
            </div>
        </form>
    </div>
</div>
