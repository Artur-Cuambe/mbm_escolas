<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Visualizar Armazem</h3>
        <div class="right">
            <button type="button" class="btn btn-remove" data-dismiss="modal"><i class="fa fa-close"></i></button>
        </div>
    </div>
    <div class="card-body">
        <?php
        if (isset($_SESSION['msg'])):
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        endif;
        if (!empty($this->Dados[0]['id'])):
            ?>
            <h4 class="heading">Detalhes do Armazem</h4>
            <dl class="row">
                <dt class="col-sm-4">ID</dt>
                <dd class="col-sm-8 text-left border-bottom"><?php echo $this->Dados[0]['id']; ?></dd>

                <dt class="col-sm-4">Nome</dt>
                <dd class="col-sm-8 text-left border-bottom"><?php echo $this->Dados[0]['descricao']; ?></dd>

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