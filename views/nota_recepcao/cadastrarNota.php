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
        <h6> &nbsp;&nbsp;Nova Nota De Recepção Para Novos Artigos</h6>
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


        if (isset($this->Dados)):
            $valorForm = $this->Dados;
        //var_dump($valorForm['id_armazem']);        die();
        endif;
        ?>
        <form name="basic-form" id="basic-form" action="" method="post" enctype="multipart/form-data" novalidate>

            <div class="form-group row">
                <label for="id_factura" class="col-sm-3 col-form-label">N° da Factura</label>
                <div class="col-sm-9">
                    <input type="text"  id="id_factura" class="form-control" name="id_factura" placeholder="N° da Factura" value="<?php
                    if (isset($valorForm['id_factura'])): echo $valorForm['id_factura'];
                    endif;
                    ?>" required>
                </div>
            </div>

            <!--            <div class="form-group row">
                            <label for="id_factura" class="col-sm-3 col-form-label">Lote N°</label>
                            <div class="col-sm-9">
                                <input type="text"  id="id_factura" class="form-control" name="nr_lote" placeholder="Lote N°" value="<?php
            if (isset($valorForm['nr_lote'])): echo $valorForm['nr_lote'];
            endif;
            ?>" required>
                            </div>
                        </div>-->

            <input type="hidden" name="created" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input type="hidden" name="basic-form" value="Dados">

            <div class="form-group row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <button type="button" id='refresh' class="btn btn-primary btn-block" onclick="enviarDados('<?php echo URL; ?>controle-nota/cadastrar/<?= $valorForm['id_armazem'] ?>', 'basic-form')" value="REGISTAR" name="basic-form">REGISTAR</button>
                </div>
            </div>
        </form>
    </div>
</div>