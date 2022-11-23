<div class="box">
    <header class="dark" style="">
        <div class="icons"><i class="icon-plus-sign"></i></div>
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
        <h6> &nbsp;&nbsp;Registar Utilizador</h6>
    </header>
    <div id="collapse2" class="body collapse in">
        <?php
        if (isset($_SESSION['msg'])):
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        endif;

        if (isset($this->Dados[0])):
            $niveisAcessos = $this->Dados[0];
        //var_dump($niveisAcessos);
        endif;
        if (isset($this->Dados[1])):
            $situacaoUsers = $this->Dados[1];
        //var_dump($situacaoUsers);
        endif;
        if (isset($this->Dados[2])):
            $valorForm = $this->Dados[2];
        //var_dump($valorForm);
        endif;
        ?>

        <form name="basic-form" id="basic-form"  class="form-horizontal" action="" method="post" enctype="multipart/form-data" novalidate>

            <div class="form-group row">
                <label for="name" class="col-sm-4 col-form-label">Nome</label>
                <div class="col-sm-8">
                    <input type="text"  id="name" class="form-control" name="name" placeholder="Nome completo" value="<?php
                    if (isset($valorForm['name'])): echo $valorForm['name'];
                    endif;
                    ?>" required>
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-sm-4 col-form-label">E-mail:</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="email"  name="email" placeholder="Seu melhor e-mail" value="<?php
                    if (isset($valorForm['email'])): echo $valorForm['email'];
                    endif;
                    ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-sm-4 col-form-label">Senha:</label>
                <div class="col-sm-8">
                    <input type="password"  class="form-control" id="password" name="password" placeholder="Senha">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-4 col-form-label">Foto:</label>
                <div class="col-sm-8">
                    <input type="file" class="form-control"   name="foto"/>
                </div>
            </div>

            <div class="form-group row">
                <label for="niveis_acesso_id" class="col-sm-4 col-form-label">Nivel Acesso</label>
                <div class="col-sm-8">
                    <select class="form-control select-basic " id="niveis_acesso_id" name="niveis_acesso_id" required style="width: 100%;">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($niveisAcessos as $nivelAcesso):
                            extract($nivelAcesso);
                            if ($valorForm['niveis_acesso_id'] == $id):
                                $selecionado = "selected";
                            else:
                                $selecionado = "";
                            endif;
                            echo "<option value='$id' $selecionado>$nome_niveis_acesso</option>";
                        endforeach;
                        ?>
                    </select> 
                </div>
            </div>

            <div class="form-group row">
                <label for="situacoes_user_id" class="col-sm-4 col-form-label">Situação Utilizador</label>
                <div class="col-sm-8">
                    <select class="form-control select-basic " id="situacoes_user_id" name="situacoes_user_id" required style="width: 100%;">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($situacaoUsers as $situacaoUser):
                            extract($situacaoUser);
                            if ($valorForm['situacoes_user_id'] == $id):
                                $selecionado = "selected";
                            else:
                                $selecionado = "";
                            endif;
                            echo "<option value='$id' $selecionado>$nome_sit_user</option>";
                        endforeach;
                        ?>
                    </select> 
                </div>
            </div>

            <input type="hidden" name="created" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input type="hidden" name="basic-form" value="Dados">

            <div class="form-group row">
                <div class="col-sm-6"></div>
                <div class="col-sm-4">
                    <button type="button" id='refresh' class="btn btn-primary btn-block" onclick="enviarDadosFile('<?php echo URL; ?>controle-usuario/cadastrar')" value="REGISTAR" name="basic-form">REGISTAR</button>
                </div>
            </div>
        </form>
    </div>
</div>
