<?php
if (isset($this->Dados[0])):
    $valorForm = $this->Dados[0];
//var_dump($valorForm);
elseif (isset($this->Dados)):
    $valorForm = $this->Dados;
//var_dump($valorForm);
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
        <?php
        if (isset($_SESSION['msg'])):
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        endif;
        ?>
        <form name="basic-form" id="basic-form" action="" method="post" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="id" value="<?php
            if (isset($valorForm['id'])):
                echo $valorForm['id'];
            endif;
            ?>">
            <div class="form-group row">
                <label for="nome_menu" class="col-sm-3 col-form-label">Nome</label>
                <div class="col-sm-9">
                    <input type="text"  id="nome_menu" class="form-control" name="nome_menu" placeholder="Nome do Método a ser apresentado no menu" value="<?php
                    if (isset($valorForm['nome_menu'])): echo $valorForm['nome_menu'];
                    endif;
                    ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="obs" class="col-sm-3 col-form-label">Descrição </label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="obs" id="obs" placeholder="Descrição do Método a ser apresentado no menu" required><?php
                        if (isset($valorForm['obs'])):
                            echo $valorForm['obs'];
                        endif;
                        ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="icon" class="col-sm-3 col-form-label">Icon</label>
                <div class="col-sm-9">
                    <input type="text"  id="icon" class="form-control" name="icon" placeholder="Icon do Método a ser apresentado no menu" value="<?php
                    if (isset($valorForm['icon'])): echo $valorForm['icon'];
                    endif;
                    ?>" required>
                </div>
            </div>

            <input type="hidden" name="modified" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input type="hidden" name="basic-form" value="Dados">

            <div class="form-group row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <input type="button" class="btn btn-success btn-grad" onclick="enviarDados('<?php echo URL; ?>controle-methodo/editar/<?php echo $valorForm['id']; ?>', 'basic-form')" value="SALVAR" name="basic-form">
                </div>
            </div>
        </form>
    </div>
</div>