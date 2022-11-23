<div class="main">
    <!--MAIN CONTENT--> 
    <div class="main-content">
        <div class="content-heading">
            <div class="heading-left">
                <h1 class="page-title">Registar nivel de acesso</h1>
                <!--<p class="page-subtitle">Ready-to-use form layouts.</p>-->
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
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <!--SUBMIT TICKETS--> 
                    <br><br>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Novo nivel de acesso</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($_SESSION['msg'])):
                                echo $_SESSION['msg'];
                                unset($_SESSION['msg']);
                            endif;
                            if (isset($this->Dados[1])):
                                $departamentos = $this->Dados[1];
//                            var_dump($departamentos);
                            endif;
                            if (isset($this->Dados[0])):
                                $valorForm = $this->Dados[0];
//var_dump($valorForm);
                            endif;
                            ?>
                            <form name="CadNivelAcesso" id="basic-form" action="" method="post" enctype="multipart/form-data" novalidate>
                                <div class="form-group row">
                                    <label for="nome_niveis_acesso" class="col-sm-3 col-form-label">Nome</label>
                                    <div class="col-sm-9">
                                        <input type="text"  id="nome_niveis_acesso" class="form-control" name="nome_niveis_acesso" placeholder="Nome do Nivel de Acesso" value="<?php
                                        if (isset($valorForm['nome_niveis_acesso'])): echo $valorForm['nome_niveis_acesso'];
                                        endif;
                                        ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="departamento_id" class="col-sm-3 col-form-label">Departamento</label>
                                    <div class="col-sm-9">
                                        <select class="form-control select-basic " name="departamento_id" id="departamento_id" required>
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

                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-9">
                                        <input type="submit" class="btn btn-primary btn-block" value="REGISTAR" name="SendCadNivelAcesso">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- END WRAPPER -->