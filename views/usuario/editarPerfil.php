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
        <h6> &nbsp;&nbsp;Editar Perfil</h6>
    </header>
    <div id="collapse2" class="body collapse in">
        <?php
        if (isset($_SESSION['msg'])):
            echo $_SESSION['msg'];
        // unset($_SESSION['msg']);
        endif;

        if (isset($this->Dados[0])):
            $valorForm = $this->Dados[0];
//var_dump($valorForm);
        elseif (isset($this->Dados)):
            $valorForm = $this->Dados;
        endif;
        ?>
        <form name="basic-form" id="basic-form"  class="form-horizontal" action="" method="post" enctype="multipart/form-data" novalidate>
            <input type="hidden" name="id" value="<?php
            if (isset($valorForm['id'])):
                echo $valorForm['id'];
            endif;
            ?>">
            <div class = "form-group row">
                <label for = "name" class = "col-sm-4 col-form-label">Nome</label>
                <div class = "col-sm-8">
                    <input type = "text" id = "name" class = "form-control" name = "name" placeholder = "Nome completo" value = "<?php
                    if (isset($valorForm['name'])): echo $valorForm['name'];
                    endif;
                    ?>" required>
                </div>
            </div>

            <div class = "form-group row">
                <label for = "email" class = "col-sm-4 col-form-label">E-mail:</label>
                <div class = "col-sm-8">
                    <input type = "email" class = "form-control" id = "email" name = "email" placeholder = "Seu melhor e-mail" value = "<?php
                    if (isset($valorForm['email'])): echo $valorForm['email'];
                    endif;
                    ?>">
                </div>
            </div>

            <div class = "form-group row">
                <label for = "password" class = "col-sm-4 col-form-label">Senha:</label>
                <div class = "col-sm-8">
                    <input type = "password" class = "form-control" id = "password" name = "password" placeholder = "Senha">
                </div>
            </div>

            <div class = "form-group row">
                <label class = "col-sm-4 col-form-label">Foto:</label>
                <div class = "col-sm-8">
                    <input type = "file" class = "form-control" name = "foto"/>
                </div>
            </div>


            <input type="hidden" name="modified" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input type="hidden" name="foto_antiga" value="<?php
            if (isset($valorForm['foto_antiga'])):
                echo $valorForm['foto_antiga'];
            elseif (isset($valorForm['foto'])):
                echo $valorForm['foto'];
            endif;
            ?>">
            <input type="hidden" name="basic-form" value="Dados">

            <div class="form-group row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <button type="button" id='refresh' class="btn btn-primary btn-block" onclick="enviarDadosFile('<?php echo URL; ?>controle-usuario/editar-perfil/')" value="SALVAR" name="basic-form">SALVAR</button>
                </div>
            </div>
        </form>
    </div>
</div>