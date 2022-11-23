
<div class="box">
    <header class="dark" style="">
        <div class="icons"><i class="icon-eye-open"></i></div>
        <div class="toolbar">
            <ul class="nav">
                <li>
                    <div class="btn-group">
                        <a class="accordion-toggle btn btn-xs minimize-box" 
                           href="#" data-dismiss="modal">
                            <i class="icon-remove"></i> 
                        </a>

                    </div>
                </li>
            </ul>
        </div>
        <h6> &nbsp;&nbsp;Vizualizar Artigo</h6>
    </header>
    <div id="collapse2" class="body collapse in">
        <?php
        if (isset($_SESSION['msg'])):
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        endif;
        if (!empty($this->Dados[0]['id'])):
            ?>
            <h4 class="heading">Detalhes do Artigo</h4>
            <dl class="row">
                <dt class="col-sm-4">ID</dt>
                <dd class="col-sm-8 text-left border-bottom"><?php echo $this->Dados[0]['id']; ?></dd>

                <dt class="col-sm-4">Código</dt>
                <dd class="col-sm-8 text-left border-bottom"><?php echo $this->Dados[0]['cod']; ?></dd>

                <dt class="col-sm-4">Nome</dt>
                <dd class="col-sm-8 text-left border-bottom"><?php echo $this->Dados[0]['nome']; ?></dd>

                <dt class="col-sm-4">Inserido</dt>
                <dd class="col-sm-8 text-left border-bottom"><a href="#"><?php echo date('d/m/Y H:i:s', strtotime($this->Dados[0]['created'])); ?></a></dd>

                <dt class="col-sm-4">Alterado</dt>
                <dd class="col-sm-8 text-left border-bottom"><a href="#"><?php
                        if (!empty($this->Dados[0]['modified'])):
                            echo date('d/m/Y H:i:s', strtotime($this->Dados[0]['modified']));
                        endif;
                        ?></a></dd>
            </dl>
            <?php
        else:
            echo "<div class='alert alert-danger'>Nenhum dado encontrado.</div>";
        endif;
        ?>
    </div>
</div>