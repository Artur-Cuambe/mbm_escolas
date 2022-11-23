<div class="panel panel-default d-flex justify-content-between align-items-center">

    <div class="panel-heading">
        Editar Permissão

        <div class="pull-right" style="margin-top: -6px;">
            <button type="button" class="label label-default" data-dismiss="modal"><i class=" icon-remove"></i></button>
        </div> 
    </div>

    <?php
    if (!empty($this->Dados)):
        ?>
        <form name="basic-form" id="basic-form" class="form-horizontal" action="" method="post" enctype="multipart/form-data">


            <div class="panel-body">
                <div class="list-group">
                    <?php foreach ($this->Dados as $permissoes): ?>
                        <?php
                        extract($permissoes);
                        if (!isset($classe_valor)):
                            ?>

                            <a href="#" class="list-group-item">
                                <i class=" icon-sitemap"></i> Classe
                                <span class="pull-right text-warning "><?= $classes ?></span>
                            </a>

                            <a href="#" class="list-group-item">
                                <i class=" icon-dollar"></i> Metodo
                                <span class="pull-right text-warning "> <?= $methodos ?></span>
                            </a>

                            <?php
                            $classe_valor = $classes;
                        endif;
                        ?>



                        <dl class="">
                            <?php
                            if ($niveis_acesso_id == 1):
                                if ($situacao_permissao == 1) :
                                    ?>

                                    <a href="#" class="list-group-item active-result">
                                        <?= $niveis_acessos ?>
                                        <span class="pull-right text-muted small"><label class=''><input type='radio' name='nome[<?= $id ?>]' value='1' checked disabled><span class='label label-success'> Liberado</span></label></span>
                                        <span class="pull-right text-muted small"><label class=''><input type='radio' name='nome[<?= $id ?>]' value='2'  disabled><span class='label label-danger'> Bloqueado</span></label></span>
                                    </a>

                                <?php else:
                                    ?>
                                    <a href="#" class="list-group-item active-result">
                                         <?= $niveis_acessos ?>
                                        <span class="pull-right text-muted small"><label class=''><input type='radio' name='nome[<?= $id ?>]' value='1'  disabled><span class='label label-success'> Liberado</span></label></span>
                                        <span class="pull-right text-muted small"><label class=''><input type='radio' name='nome[<?= $id ?>]' value='2' checked disabled><span class='label label-danger'> Bloqueado</span></label></span>
                                    </a>

                                <?php
                                endif;
                            else:
                                if ($situacao_permissao == 1) :
                                    ?>
                                    <a href="#" class="list-group-item ">
                                        <?= $niveis_acessos ?>
                                        <span class="pull-right text-muted small"><label class=''><input name='nome[<?= $id ?>]' value='1'  type='radio' checked><span class='label label-success'> Liberado</span> </label></span>
                                        <span class="pull-right text-muted small"><label class=''><input type='radio' name='nome[<?= $id ?>]' value='2'  ><span class='label label-danger'> Bloqueado</span></label></span>
                                    </a>

                                <?php else:
                                    ?>
                                    <a href="#" class="list-group-item">
                                         <?= $niveis_acessos ?>
                                        <span class="pull-right text-muted small"><label class=''><input type='radio' name='nome[<?= $id ?>]' value='1'  ><span class='label label-success'> Liberado</span> </label> </span>
                                        <span class="pull-right text-muted small"><label class=''><input type='radio' name='nome[<?= $id ?>]' value='2' checked ><span class='label label-danger'> Bloqueado</span> </label></span>
                                    </a>

                                <?php
                                endif;
                            endif;
                            ?>
                        </dl>

                        <?php
                    endforeach;
                    ?>
                    <input type="hidden" name="basic-form" value="Dados">
                    <input type="submit" class="btn btn-default btn-block btn-primary" onclick="enviarDados('<?php echo URL; ?>controle-login/editar-permissao/<?= $this->Dados[0]['methodo_id'] ?>', 'basic-form')" value="SALVAR" name="basic-form">
                </div>
            </div>
        </form>

        <?php
    endif;
    //var_dump($this->Dados);
    ?>
</div>
