<!--PAGE CONTENT -->
<!--<div id="content">-->
    <div class="inner">
        <div class="row">
            <div class="col-lg-12">
                <h2> Listar Artigos </h2>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Registos de Artigos
                        <div class="pull-right" style="margin-top: -5px;">
                            <p><a href="#"  onclick="chamarTela('<?php echo URL; ?>controle-artigo/cadastrar')"><button type="button" class="btn btn-primary btn-sm btn-rect  btn-grad"><i class='icon-plus-sign'></i> Novo Artigo</button></a>
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
                                            <th>Código</th>
                                            <th>Nome</th>
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
                                                <td><?php echo $cod; ?></td>
                                                <td><?php echo $nome; ?></td>
                                                <td><?php echo date('d/m/Y H:i', strtotime($created)); ?></td>
                                                <td class="text-right">

                                                    <div class="btn-group pull-right">
                                                        <a class="btn btn-primary btn-grad btn-sm" href="#" onclick="chamarTela('<?php echo URL; ?>controle-artigo/visualizar/<?php echo $id; ?>')"><span class="sr-only">Refresh</span> <i class="icon-eye-open"></i></a>
                                                        <a class="btn btn-warning btn-grad btn-sm " onclick="chamarTela('<?php echo URL; ?>controle-artigo/editar/<?php echo $id; ?>')"href="#"><span class="sr-only">Ok</span><i class="icon-edit"></i></a>
                                                        <a class="btn btn-danger btn-grad btn-sm " onclick="enviaDados('<?php echo URL; ?>controle-artigo/apagar/<?php echo $id; ?>', {id: <?= $id ?>}, 'apagar')" href="#"><i class="icon-trash"></i></a>
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