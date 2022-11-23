<!--PAGE CONTENT -->
<!--<div id="content">-->
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h2> Listar Stock </h2>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Registos de Artigos
                    <div class="pull-right" style="margin-top: -5px;">
                        <p>
                            <a href="#"  onclick="enviaDados('<?php echo URL; ?>controle-armazem/index', null, 'content')"><button type="button" class="btn btn-primary btn-sm btn-rect  btn-grad"><i class=' icon-th-large'></i>  Listar Armazens</button></a>
                        </p>
                    </div>
                </div>
                <div class="panel-body">
                    <?php
                    if (isset($_SESSION['msg'])):
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    endif;
                    if (isset($_SESSION['msgcad'])):
                        echo $_SESSION['msgcad'];
                        unset($_SESSION['msgcad']);
                    endif;
//                        $paginacao = $this->Dados[1];
//                        $this->Dados = $this->Dados[0];
                    if (!empty($this->Dados)):
                        ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Código</th>
                                        <th>Artigo</th>
                                        <th>Quantidade</th>
                                        <th>Preço</th>
                                        <th>Iva</th>
                                        <th>Data de entrada</th>
                                        <!--<th class="text-right">Ações</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($this->Dados as $nivelAcesso) :
                                        extract($nivelAcesso);
                                        ?>               
                                        <tr>
                                            <td><?php echo $cod; ?></td>
                                            <td class="hidden-xs "><?php echo $nome; ?></td>
                                            <td class="hidden-xs "><?php echo $quantidade; ?></td>
                                            <td class="hidden-xs "><?php echo $preco; ?></td>
                                            <td class="hidden-xs "><?php
                                                if ($iva == 17) {
                                                    echo "IVA incluído ({$iva}%)";
                                                } else {
                                                    echo 'Sem IVA incluído';
                                                }
                                                ?></td>
                                            <td><?php echo date('d/m/Y', strtotime($created)); ?></td>
        <!--                                                <td class="text-right">
                                              
                                                <a onclick="chamarTela('<?php echo URL; ?>controle-armazem/visualizar/<?php echo $id; ?>')" href="#" data-toggle="tooltip" data-placement="top" title="Visualizar Armazem"><button type="button" class="btn btn-primary"><i class="fa fa-eye"></i>   </button></a>

                                                <a onclick="chamarTela('<?php echo URL; ?>controle-armazem/editar/<?php echo $id; ?>')" href="#" data-toggle="tooltip" data-placement="top" title="Editar Armazem"><button type="button" class="btn btn-dark"><i class="fa fa-edit"></i> </button></a>

                                                <a onclick="enviaDados('<?php echo URL; ?>controle-armazem/apagar/<?php echo $id; ?>', {id: <?= $id ?>}, 'apagar')" href="#" data-toggle="tooltip" data-placement="top" title="Eliminar Armazem"><button type="button" class="btn btn-danger"><i class="fa fa-trash"></i> </button></a>

                                            </td>-->
                                        </tr>

                                        <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
//                            echo $paginacao;
                    endif;


                    //var_dump($this->Dados);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--</div>-->
<script> $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });</script>