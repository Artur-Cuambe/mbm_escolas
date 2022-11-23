<div class="panel panel-default d-flex justify-content-between align-items-center">
    <?php if (!empty($this->Dados[0]['id'])): ?>
        <div class="panel-heading">
            Visualizar Nível de Acesso

            <div class="pull-right" style="margin-top: -6px;">
                <button type="button" class="label label-default" data-dismiss="modal"><i class=" icon-remove"></i></button>
            </div> 
        </div>
        <div class="panel-body">
            <?php
            if (isset($_SESSION['msg'])):
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            endif;
            ?>
            <blockquote class="pull-right">
                <p><i class="icon-cogs icon-5x"></i></p>
            </blockquote>
            <h4>Nome</h4>
            <blockquote>
                <h5>[<?php echo $this->Dados[0]['id']; ?>] <?php echo $this->Dados[0]['nome_niveis_acesso']; ?></h5>
            </blockquote>
                       
            <?php if (!empty($this->Dados[0]['descricao'])): ?>
                <h4>Descrição</h4>
                <blockquote>
                    <p><?php echo $this->Dados[0]['descricao']; ?></p>
                </blockquote>
                <?php
            endif;
            ?>
            <blockquote class="pull-right">
                <p>Registado no dia: <?php echo date('d/m/Y H:i:s', strtotime($this->Dados[0]['created'])); ?></p>
    <?php
    if (!empty($this->Dados[0]['modified'])):
        echo '<p>Última modificação do dia ' . date('d/m/Y H:i:s', strtotime($this->Dados[0]['modified'])) . '</p>';
    endif;
    ?>
            </blockquote>
        </div>
    <?php
else:
    echo "<div class='alert alert-danger'>Nenhum dado encontrado.</div>";
endif;
?>
</div>

