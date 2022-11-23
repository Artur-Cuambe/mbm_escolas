<!--PAGE CONTENT -->
<!--<div id="content">-->
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h2> Listar Armazens </h2>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Registos de Armazens
                    <div class="pull-right" style="margin-top: -5px;">
                        <p><a href="#"  onclick="chamarTela('<?php echo URL; ?>controle-armazem/cadastrar')"><button type="button" class="btn btn-primary btn-sm btn-rect  btn-grad"><i class='icon-plus-sign'></i> Novo Armazem</button></a>
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
                    $paginacao = $this->Dados[1];
                    $this->Dados = $this->Dados[0];
                    if (!empty($this->Dados)):
                        ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Laboratório</th>
                                        <th>Data | Hora</th>
                                        <th class="text-right">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($this->Dados as $nivelAcesso) :
                                        extract($nivelAcesso);
                                        ?>               
                                        <tr>
                                            <td><?php echo $id; ?></td>
                                            <td class="hidden-xs "><?php echo $descricao; ?></td>
                                            <td class="hidden-xs "><?php echo $departamento; ?></td>
                                            <td><?php echo date('d/m/Y H:i', strtotime($created)); ?></td>
                                            <td class="text-right">
                                                &nbsp;
                                                <div class="btn-group pull-right">
                                                    <a class="btn btn-info btn-grad btn-sm" onclick="chamarTela('<?php echo URL; ?>controle-armazem/visualizar/<?php echo $id; ?>')" href="#" data-toggle="tooltip" data-placement="top" title="Visualizar Armazem"><i class="icon-eye-open"></i> </a>

                                                    <a class="btn btn-warning btn-grad btn-sm" onclick="chamarTela('<?php echo URL; ?>controle-armazem/editar/<?php echo $id; ?>')" href="#" data-toggle="tooltip" data-placement="top" title="Editar Armazem"><i class="icon-edit"></i></a>

                                                    <a class="btn btn-danger btn-grad btn-sm" onclick="enviaDados('<?php echo URL; ?>controle-armazem/apagar/<?php echo $id; ?>', {id: <?= $id ?>}, 'content')" href="#" data-toggle="tooltip" data-placement="top" title="Eliminar Armazem"><i class="icon-trash"></i></a>
                                                </div>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                <div class="btn-group">
                                                    <button data-toggle="dropdown" class="btn btn-primary btn-grad btn-sm dropdown-toggle">Stock <span class="caret"></span></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#" href="#" onclick="enviaDados('<?php echo URL; ?>controle-armazem/stock/<?php echo $id; ?>', null, 'content')"> Stock Disponível  <i class="icon-minus-sign"></i></a></li>
                                                        <li><a href="#" onclick="chamarTela('<?php echo URL; ?>controle-nota/cadastrar/<?php echo $id; ?>')">Entradas <i class="icon-plus-sign"></i></a></li>
                                                        <li class="divider"></li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>

                                        <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                        echo $paginacao;
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