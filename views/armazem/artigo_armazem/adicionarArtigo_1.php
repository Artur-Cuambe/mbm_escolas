<div class="main">

    <!-- MAIN CONTENT -->
    <div class="main-content">

        <div class="content-heading">
            
            <div class="heading-left">
                <h1 class="page-title">Adicionar Artigo </h1>
                <p class="page-subtitle">Adicionar artigo ao armzem</p>
            </div>
            
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Parent</a></li>
                    <li class="breadcrumb-item active">Current</li>
                </ol>
            </nav>
        </div>

        <div class="container-fluid container">
            <div class="row">
                <!--<div class="col-md-1"></div>-->
                <div class="col-md-12">


                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Adicionar Artigos</h3>
                            <div class="right">
                                <!--<button type="button" class="btn btn-remove" data-dismiss="modal"><i class="fa fa-close"></i></button>-->
                            </div>
                        </div>
                        <div class="card-body">

                            <?php
                            if (isset($_SESSION['msg'])):
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            endif;
                            if (isset($_SESSION['msgcad'])):
                                echo $_SESSION['msgcad'];
                                unset($_SESSION['msgcad']);
                            endif;

                            if (isset($this->Dados[0])):
                                $departamentos = $this->Dados[0];
                            //var_dump($catArtigos);
                            endif;
                            if (isset($this->Dados[1])):
                                $valorForm = $this->Dados[1];
                            //var_dump($valorForm);
                            endif;
                            ?>
                            <form   name="CadNivelAcesso" class="form-horizontal" id="basic-form" action="" method="post" novalidate>
                                <input type="hidden" name="created" value="<?php echo date("Y-m-d H:i:s"); ?>">
                                <div class="row">
                                    <label for="nome_niveis_acesso" class="col-sm-3 col-form-label">Código da Nota de Recep.</label>
                                    <div class="col-sm-3"><input type="text"  id="nome" class="form-control pull-left" name="nome[]" placeholder="Código da Nota de Recep."  required></div>
                                </div>
                                <div class="row">
                                    <label for="nome_niveis_acesso" class="col-sm-2 col-form-label">Artigo</label>
                                    <label for="nome_niveis_acesso" class="col-sm-2 col-form-label">Preço</label>
                                    <label for="nome_niveis_acesso" class="col-sm-2 col-form-label">Com IVA/Sem IVA</label>
                                    <label for="nome_niveis_acesso" class="col-sm-2 col-form-label">QTD</label>
                                    <label for="nome_niveis_acesso" class="col-sm-2 col-form-label">Validade</label>
                                    <label for="nome_niveis_acesso" class="col-sm-2 col-form-label "><span class="pull-right">ADICIONAR CAMPOS</span></label>
                                </div>
                                <div id="divDescricao">
                                    <div class="row" >
                                        <div class="col-sm-2"><input type="text"  id="nome" class="form-control" name="nome[]" placeholder="Descrição"  required></div>
                                        <div class="col-sm-2"><input type="text" class="form-control" onkeyup="reformatText(this)" id="preco" name="preco[]" style="text-align: right;" placeholder="Preço (MZN)" required></div>
                                        <div class="col-sm-2"><select class="form-control" name="iva[]" id="iva" required style="width: 100%;"><option value="">Selecione</option><option value="17">Com IVA</option><option value="0">Sem IVA</option></select></div>
                                        <div class="col-sm-2"><input type="number" min="0"  id="quantidade" class="form-control" name="quantidade[]" placeholder="Quantidade" required></div>
                                        <div class="col-sm-2"><input data-provide="datepicker" data-date-autoclose="true" placeholder="Validade" name="validade[]" class="form-control" data-date-format="dd/mm/yyyy" required></div>
                                        <div class="col-sm-2"><button type="button"  name="add" id="add"  class="btn btn-primary pull-right" onclick="" ><i class="fa fa-plus"></i></button></div>

                                    </div>
                                </div><br>
                                <div class="form-group row">
                                    <div class="col-md-5 pull-left"> </div>
                                    <div class="col-md-7 ">
                                        <button type="submit"  name="SendCadArtigo"  class="btn btn-primary pull-right" onclick="" ><i class="fa fa-save"></i> Salvar</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->


</div>
<script>
    ///$(":input").inputmask();
    String.prototype.reverse = function () {
        return this.split("").reverse().join("");
    }

    function reformatText(input) {
        var x = input.value;
        x = x.replace(/,/g, ""); // Strip out all commas
        x = x.reverse();
        x = x.replace(/.../g, function (e) {
            return e + ",";
        }); // Insert new commas
        x = x.reverse();
        x = x.replace(/^,/, ""); // Remove leading comma
        input.value = x;
    }

    $(document).ready(function () {
        var i = 1;

        $('#add').click(function () {
            $("#cod").focus();
            table = '<br><div class="row" id="row' + i + '">';
            table += '<div class="col-sm-1"> <input type="text"  id="cod' + i + '" class="form-control" name="cod[]" placeholder="Código" required></div>';
            table += '<div class="col-sm-2"><input type="text"  id="nome' + i + '" class="form-control" name="nome[]" placeholder="Descrição"  required></div>';
            table += '<div class="col-sm-2"><input type="text" class="form-control" onkeyup="reformatText(this)" id="preco' + i + '" name="preco[]" style="text-align: right;" placeholder="Preço (MZN)" required></div>';
            table += '<div class="col-sm-2"><select class="form-control" name="iva[]" id="iva' + i + '" required style="width: 100%;"><option value="">Selecione</option><option value="17">Com IVA</option><option value="0">Sem IVA</option></select></div>';
            table += '<div class="col-sm-2"><input type="number" min="0"  id="quantidade' + i + '" class="form-control" name="quantidade[]" placeholder="Quantidade" required></div>';
            table += '<div class="col-sm-2"><input data-provide="datepicker" data-date-autoclose="true" placeholder="Validade" id="validade' + i + '" name="validade[]" class="form-control" data-date-format="dd/mm/yyyy" required></div>';
            table += '<div class="col-sm-1"> <button type="button"  name="remove" id="' + i + '" class="btn btn-danger btn_remove " ><i class="fa fa-minus"></i></button></div>';
            table += '</div>';
            i++;
            $('#divDescricao').append(table);
        });

        $(document).on('click', '.btn_remove', function () {
            var button_id = $(this).attr("id");
            $("#row" + button_id + '').remove();
        });

    });
</script>