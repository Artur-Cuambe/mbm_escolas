<div class="panel panel-default">
    <div class="panel-heading">
        Dados do Utilizador
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
            <p><i class="icon-user icon-5x"></i></p>

        </blockquote>
        <br>
        <br>
        <h4>Nome</h4>
        <blockquote>
            <p><?php echo $this->Dados[0]['name']; ?> </p>
        </blockquote>
        <h4>Perfil</h4>
        <blockquote>
            <p><?php
                $foto = URL . "assets/imagens/usuarios/" . $this->Dados[0]['id'] . "/" . $this->Dados[0]['foto'];
                if (!empty($this->Dados[0]['foto'])):
                    echo "<img src='$foto'  width='150' alt='Avatar'>";
                else:
                    $foto = URL . "assets/imagens/adm/icone-usuario.png";
                    echo "<img src='$foto' width='150' alt='Avatar'>";
                endif;
                ?></p>
            <small style="color: #000;">Email:
                <cite title="<?php echo $this->Dados[0]['email']; ?>"><?php echo $this->Dados[0]['email']; ?></cite>
            </small>
            <small style="color: #000;">Nível de Acesso:
                <cite title="<?php echo $this->Dados[0]['nivel']; ?>(a)"><?php echo $this->Dados[0]['nivel']; ?>(a)</cite>
            </small>
            <small style="color: #000;">Situação do Utilizador:
                <cite title="<?php echo $this->Dados[0]['situacao']; ?>"><?php echo $this->Dados[0]['situacao']; ?></cite>
            </small>
        </blockquote>
        <blockquote class="pull-right">
            <p>Registado no dia: <?php echo date('d/m/Y H:i:s', strtotime($this->Dados[0]['created'])); ?></p>
            <?php
            if (!empty($this->Dados[0]['modified'])):
                echo '<p>Última modificação do dia ' . date('d/m/Y H:i:s', strtotime($this->Dados[0]['modified'])) . '</p>';
            endif;
            ?>
        </blockquote>
    </div>
</div>
