<!--PAGE CONTENT -->
<div id="content">
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">
                <h2>Adicionar artigo ao armzem</h2>
            </div>
        </div>
        <hr />
        <div class="row">
            <!-- left column -->
            <div class="col-md-4">

                <div class="box">
                    <header class="dark" style="">
                        <div class="icons"><i class="icon-plus-sign"></i></div>
                        <div class="toolbar">
                            <ul class="nav">
                                <li>
                                    <div class="btn-group">
                                        <div class="pull-right">
                                            <a href="<?php echo URL; ?>controle-armazem/terminar"><button class="btn btn-danger btn-sm" ><i class="fa fa-close"></i> <span class="sr-only"></span>Terminar Registo</button></a>
                                        </div>

                                    </div>
                                </li>
                            </ul>
                        </div>
                        <h6> &nbsp;&nbsp;Adicionar Artigo</h6>
                    </header>
                    <div id="collapse2" class="body collapse in">
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
                            // var_dump($this->Dados);
                            if (isset($this->Dados[0])):
                                $valorForm = $this->Dados[0];
                            else:
                            //var_dump($valorForm);
                            endif;

                            if (isset($this->Dados[1][0])):
                                $artigos = $this->Dados[1][0];
                            // var_dump($artigos);
                            endif;
                            if (isset($this->Dados[1][1])):
                                $unidades = $this->Dados[1][1];
                            // var_dump($unidades);
                            endif;

                            if (isset($this->Dados[2])):
                                $listaRegistos = $this->Dados[2];
                            //   var_dump($listaRegistos);
                            endif;
                            ?>
                            <form name="CadNivelAcesso" class="form-horizontal" id="basic-form" action="" method="post" novalidate>

                                <div class="form-group row">
                                    <label for="id_nota_recepcao" class="col-sm-4 col-form-label">Nota De Recepção</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="id_factura" name="id_nota_recepcao" placeholder="Nota De Recepção" value="<?php
                                        if (isset($_SESSION['nota_recepcao' . $_SESSION['id']])): echo $_SESSION['nota_recepcao' . $_SESSION['id']];
                                        endif;
                                        ?>" required readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="id_artigo" class="col-sm-4 col-form-label">Artigos</label>
                                    <div class="col-sm-8">
                                        <select class="form-control  select-basic" name="id_artigo" id="id_artigo" required>
                                            <option value="">Selecione</option>
                                            <?php
                                            foreach ($artigos as $artigo):
                                                extract($artigo);
                                                if ($valorForm['id_artigo'] == $id):
                                                    $selecionado = "selected";
                                                else:
                                                    $selecionado = "";
                                                endif;
                                                echo "<option value='$id' $selecionado>$nome</option>";
                                            endforeach;
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="quantidade_encomendada" class="col-sm-4 col-form-label">QTD Encom...</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="quantidade_encomendada" name="quantidade_encomendada" placeholder="Quantidade Encomendada"
                                               value="<?php
                                               if (isset($valorForm['quantidade_encomendada'])): echo $valorForm['quantidade_encomendada'];
                                               endif;
                                               ?>"required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="quantidade_rebida" class="col-sm-4 col-form-label">QTD Recebida</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" id="quantidade_rebida" name="quantidade_rebida" placeholder="Quantidade Recebida" value="<?php
                                        if (isset($valorForm['quantidade_rebida'])): echo $valorForm['quantidade_rebida'];
                                        endif;
                                        ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="unidade_medida_id" class="col-sm-4 col-form-label">UN. DE Medida</label>
                                    <div class="col-sm-8">
                                        <select class="form-control select-basic" name="unidade_medida_id" id="unidade_medida" required >
                                            <option value="">Selecione</option>
                                            <?php
                                            foreach ($unidades as $unidade):
                                                extract($unidade);
                                                if ($valorForm['unidade_medida_id'] == $id):
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
                                <div class="form-group row">
                                    <label for="preco_unitario" class="col-sm-4 col-form-label">Preço Unitário</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="preco_unitario" name="preco_unitario" placeholder="Preço Unitário" value="<?php
                                        if (isset($valorForm['preco_unitario'])): echo $valorForm['preco_unitario'];
                                        endif;
                                        ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="preco_compra" class="col-sm-4 col-form-label">Preço Compra</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="preco_compra" name="preco_compra" placeholder="Preço Compra" 
                                               value="<?php
                                               if (isset($valorForm['preco_compra'])): echo $valorForm['preco_compra'];
                                               endif;
                                               ?>" required>
                                    </div>
                                </div>
                                
<!--                                <div class="form-group row">
                                    <label for="preco" class="col-sm-4 col-form-label">Preço Venda</label>
                                    <div class="col-sm-8">-->
                                        <input type="hidden" class="form-control" id="preco" name="preco" placeholder="Preço venda"        
                                               value="00" required>
<!--                                    </div>
                                </div>-->
                                <div class="form-group row">
                                    <label for="ticket-name" class="col-sm-4 col-form-label">IVA</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="iva" id="iva" required>
                                            <?php
                                            if ($valorForm['iva'] == 17):
                                                $selected17 = "selected";
                                                $selected = '';
                                            else:
                                                $selected = "selected";
                                                $selected17 = '';
                                            endif;
                                            ?>
                                            <option value="">Selecione</option>
                                            <option value="17" <?= $selected17 ?>>Com IVA</option>
                                            <option value="0" <?= $selected ?>>Sem IVA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="validade" class="col-sm-4 col-form-label">Validade</label>
                                    <div class="col-sm-8">
                                        <input data-provide="datepicker" data-date-autoclose="true" placeholder="Validade" name="validade" class="form-control" data-date-format="dd/mm/yyyy" 
                                               value="<?php
                                               if (isset($valorForm['validade'])): echo $valorForm['validade'];
                                               endif;
                                               ?>"  required>
                                    </div>
                                </div>
                                <input type="hidden" name="created" value="<?php echo date("Y-m-d H:i:s"); ?>">
                                <div class="form-group row">
                                    <div class="offset-sm-3 col-sm-4">
                                        <button type="submit" class="btn btn-primary btn-block" name="SendCadArtigo" value="ADICIONAR">  ADICIONAR <span class="ti-angle-double-right"></span></button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end left column -->
            <!-- right column -->
            <div class="col-md-8">
                <div class=" ">

                    <div class="card-body">
                        <div class="profile-right">                  <!-- awards -->
                            <div class="awards">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                        if (isset($_SESSION['msgApagado'])):
                                            echo $_SESSION['msgApagado'];
                                            unset($_SESSION['msgApagado']);
                                        endif;
                                        ?>
                                    </div>
                                    <div class="table-responsive ">
                                        <table class="table table-hover" >
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Artigo</th>
                                                    <th>QTD Encomendada</th>
                                                    <th>QTD Recebida</th>
                                                    <th>UN. Medida</th>
                                                    <th>Variação</th>
                                                    <th>P. Compra (MZN)</th>
                                                    <th>Total (MZN)</th>
                                                    <th>Acção</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($listaRegistos)) {
                                                    foreach ($listaRegistos as $listaRegisto):
                                                        extract($listaRegisto);
                                                        $variacao = $quantidade_encomendada - $quantidade_rebida;
                                                        $percentagem = ($variacao * 100) / $quantidade_encomendada;
                                                        ?>
                                                        <tr>
                                                            <td><?= $nome ?></td>
                                                            <td><?= $quantidade_encomendada ?></td>
                                                            <td><?= $quantidade_rebida ?></td>
                                                            <td><?= $un_medida ?></td>
                                                            <td>
                                                                <div class="progress" title="Variação: <?= $variacao ?>">
                                                                    <div class="progress-bar" role="progressbar" aria-valuenow="<?= $percentagem ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $percentagem ?>%;">
                                                                        <span style="color: #000"><?= $percentagem ?>%</span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td><?= $preco_compra ?></td>
                                                            <td><?= $preco_compra * $quantidade_rebida ?></td>
                                                            <td>
                                                                <form name="SendDeletArtigo"  action="" method="post">
                                                                    <input type="hidden" name="id" value="<?php
                                                                    if (isset($id)):
                                                                        echo $id;
                                                                    endif;
                                                                    ?>">
                                                                    <p>
                                                                        <a class="btn btn-danger btn-grad btn-sm" onclick="enviaDados('')" href="#" data-toggle="tooltip" data-placement="top" title="Eliminar Artigo"><i class="icon-trash"></i></a>
                                                                    </p>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    endforeach;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--<div class="text-right"><a href="#" class="btn btn-outline-light"><i class="ti-file"></i> Gerar Nota de Recepção</a></div>-->
                            </div>
                            <!-- end awards -->
                        </div>
                        <!-- end right column -->
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT -->
        </div>
    </div>
</div>
<!-- END MAIN -->
