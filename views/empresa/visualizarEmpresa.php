<div class="box">
    <header class="dark" style="">
        <div class="icons"><i class="icon-edit-sign"></i></div>
        <div class="toolbar">
            <ul class="nav">
                <li>
                    <div class="btn-group">
                        <a class="accordion-toggle btn btn-xs minimize-box"  onclick="enviaDados('<?=URL.'controle-empresa/index'?>',null,'content')"
                           href="#" data-dismiss="modal">
                            <i class="icon-remove"></i> 
                        </a>

                    </div>
                </li>
            </ul>
        </div>
        <h6> &nbsp;&nbsp;Visualizar Faculdade</h6>
    </header>
    <div id="collapse2" class="body collapse in">
        <?php
        if (isset($_SESSION['msg'])):
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        endif;

        if (!empty($this->Dados[0][0]['id'])):
            $foto = URL . "assets/imagens/empresa/" . $this->Dados[0][0]['id'] . "/" . $this->Dados[0][0]['foto'];
            ?>
            <div class="row">
                <div  class="col-sm-8">
                    <h4 class="heading">Detalhes da Faculdade</h4>
                </div>
                <div  class="col-sm-4">
                    <div  class="pull-right">
                        <ul class="list-unstyled list-contacts">
                            <li>
                                <div class="media">
                                    <img src="<?php echo $foto; ?>" class="picture" alt="<?php echo $this->Dados[0][0]['foto']; ?>">
                                    <span class="status fa fa-user"></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <dl class="row">
                <dt class="col-sm-4">ID</dt>
                <dd class="col-sm-8 text-left border-bottom"><?php echo $this->Dados[0][0]['id']; ?></dd>

                <dt class="col-sm-4">NUIT</dt>
                <dd class="col-sm-8 text-left border-bottom"><?php echo $this->Dados[0][0]['nuit']; ?></dd>

                <dt class="col-sm-4">Faculdade</dt>
                <dd class="col-sm-8 text-left border-bottom"><?php echo $this->Dados[0][0]['descricao']; ?></dd>

                <dt class="col-sm-4" >E-mail</dt>
                <dd class="col-sm-8 text-left border-bottom"><?php echo $this->Dados[0][0]['email']; ?></dd>

                <dt class="col-sm-4">Telefone</dt>
                <dd class="col-sm-8 text-left border-bottom"><?php echo $this->Dados[0][0]['telefone']; ?></dd>

                <dt class="col-sm-4">Inserido</dt>
                <dd class="col-sm-8 text-left border-bottom"><a href="#"><?php echo date('d/m/Y H:i:s', strtotime($this->Dados[0][0]['created'])); ?></a></dd>

                <dt class="col-sm-4">Alterado</dt>
                <dd class="col-sm-8 text-left border-bottom"><a href="#"><?php
                        if (!empty($this->Dados[0][0]['modified'])):
                            echo date('d/m/Y H:i:s', strtotime($this->Dados[0][0]['modified']));
                        endif;
                        ?></a>
                </dd>
            </dl>
            <?php
        else:
            echo "<div class='alert alert-danger'>Nenhum dado encontrado.</div>";
        endif;
        ?>
    </div>
</div>