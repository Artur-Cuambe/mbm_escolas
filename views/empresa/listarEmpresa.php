<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h2> Listar Escolas/Faculdades </h2>
        </div>
    </div>
    <hr />
    <div class="row" >

        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Registos de Escolas/Faculdades
                    <div class="pull-right" style="margin-top: -5px;">
                        <p><a href="#"  onclick="chamarTela('<?php echo URL; ?>controle-empresa/cadastrar')"><button type="button" class="btn btn-primary btn-sm btn-rect  btn-grad"><i class='icon-plus-sign'></i> Novo Faculdade</button></a>
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
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($this->Dados as $empresa) {
                                        extract($empresa);
                                        ?>               
                                        <tr >
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $descricao; ?></td>
                                            <td class="text-right">
                                                <div class="btn-group pull-right">
                                                    <a class="btn btn-primary btn-grad btn-sm" href="#" onclick="chamarTela('<?php echo URL; ?>controle-empresa/visualizar/<?php echo $id; ?>')"><span class="sr-only">Refresh</span> <i class="icon-eye-open"></i></a>
                                                    <a class="btn btn-warning btn-grad btn-sm " onclick="chamarTela('<?php echo URL; ?>controle-empresa/editar/<?php echo $id; ?>')"href="#"><span class="sr-only">Ok</span><i class="icon-edit"></i></a>
                                                    <?php
                                                    if ($id != 1) {
                                                        ?> 
                                                        <a class="btn btn-danger btn-grad btn-sm " onclick="enviaDados('<?php echo URL; ?>controle-empresa/apagar/<?php echo $id; ?>', {id: <?= $id ?>}, 'content')" href="#"><i class="icon-trash"></i></a>
                                                            <?php
                                                        }
                                                        ?>
                                                </div>
                                            </td>
                                        </tr>

                                        <?php
                                    }
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
<script> $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });</script>