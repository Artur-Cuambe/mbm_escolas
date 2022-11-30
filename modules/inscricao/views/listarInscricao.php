<!--PAGE CONTENT -->
<!--<div idinscricao="content">-->
<div class="inner">
    <div class="row">
        <div class="col-lg-12">
            <h2> Listar processos de inscrição</h2>
        </div>
    </div>
    <!-- <pre><?=var_dump($this->Dados)?></pre>  -->
    <hr />
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Registos de processos de inscrição
                    <div class="pull-right" style="margin-top: -5px;">
                        <p><a href="#" onclick="chamarTela('<?php echo URL; ?>controle-inscricao/cadastrar')"><button
                                    type="button" class="btn btn-primary btn-sm btn-rect  btn-grad"><i
                                        class='icon-plus-sign'></i> Nova inscrição</button></a>
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
                                    <th>Precesso</th>
                                    <th>Nome</th>
                                    <th>Gênero</th>
                                    <th class="">Classe/Curso</th>
                                    <th class="">Período</th>
                                    <th class="">Turma</th>
                                    <th class="">Ano de inscrição</th>
                                    <th class="">Data de criação</th>
                                    <th class="">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i=0;
                                        foreach ($this->Dados as $nivelAcesso) :
                                            extract($nivelAcesso);
                                            $i++;
                                            ?>
                                <tr>
                                    <td><?php echo $processo; ?></td>
                                    <td><?php echo $nome; ?></td>
                                    <td><?php echo $genero; ?></td>
                                    <td><?php echo $curso; ?></td>
                                    <td><?php echo $periodo; ?></td>
                                    <td><?php echo $turma; ?></td>
                                    <td><?php echo $ano; ?></td>
                                    <td><?php echo date('d/m/Y H:i', strtotime($created)); ?></td>
                                    <td>
                                        <div class="btn-group pull-right">
                                            <a class="btn btn-primary btn-grad btn-sm" href="#"
                                                onclick="chamarTela('<?php echo URL; ?>controle-inscricao/visualizar/<?php echo $idinscricao; ?>')"><span
                                                    class="sr-only">Refresh</span> <i class="icon-eye-open"></i></a>
                                            <a class="btn btn-warning btn-grad btn-sm "
                                                onclick="chamarTela('<?php echo URL; ?>controle-inscricao/editar/<?php echo $idinscricao; ?>')"
                                                href="#"><span class="sr-only">Ok</span><i class="icon-edit"></i></a>

                                            <a class="btn btn-danger btn-grad btn-sm "
                                                onclick="enviaDados('<?php echo URL; ?>controle-inscricao/apagar/<?php echo $idinscricao; ?>', {idinscricao: <?= $idinscricao ?>}, 'content')"
                                                href="#"><i class="icon-trash"></i></a>

                                        </div>
                                    </td>
                                </tr>

                                <?php
                                        endforeach;
                                        ?>
                            </tbody>
                            </tbody>
                        </table>
                    </div>
                    <?php
                        echo $paginacao;
                        endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--</div>-->
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>