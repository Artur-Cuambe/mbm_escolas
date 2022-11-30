<div class="box">
    <header class="dark" style="">
        <div class="icons"><i class="icon-plus-sign"></i></div>
        <div class="toolbar">
            <ul class="nav">
                <li>
                    <div class="btn-group">
                        <a class="accordion-toggle btn btn-xs minimize-box" href="#" data-dismiss="modal">
                            <i class="icon-remove"></i>
                        </a>

                    </div>
                </li>
            </ul>
        </div>
        <h6> &nbsp;&nbsp;Nova inscrição</h6>
    </header>
    <div id="collapse2" class="body collapse in">
        <!-- <pre><?=var_dump($empresas = $this->Dados)?></pre> -->
        <?php
        if (isset($_SESSION['msg'])):
            echo $_SESSION['msg'];
          unset($_SESSION['msg']);
        endif;
        if (isset($_SESSION['msgcad'])):
            echo $_SESSION['msgcad'];
            unset($_SESSION['msgcad']);
        endif;

        if (isset($this->Dados[0])):
            $turmas = $this->Dados[0];
        // var_dump($turma);
        endif;
        if (isset($this->Dados[1])):
            $periodos = $this->Dados[1];
        // var_dump($periodo);
        endif;
        if (isset($this->Dados[2])):
            $cursos = $this->Dados[2];
        // var_dump($curso);
        endif;
        if (isset($this->Dados[3])):
            $estudantes = $this->Dados[3];
        // var_dump($estudante);
        endif;
        if (isset($this->Dados[4])):
            $valorForm = $this->Dados[4];
        //var_dump($valorForm);
        endif;
        if (isset($this->Dados[5])):
            $estudanteId = $this->Dados[5];
        // var_dump($estudanteId);
        else:
            $estudanteId = null;
            // var_dump($estudanteId);
        endif;
        $anos = date('Y')+1;
        ?>
        <form name="basic-form" id="basic-form" action="" method="post" enctype="multipart/form-data" novalidate>
            <div class="form-group row">
                <label for="processo" class="col-sm-3 col-form-label">Processo</label>
                <div class="col-sm-9">
                    <input type="text" id="processo" class="form-control" name="processo" placeholder="Processo" value="<?php
                    if (isset($valorForm['processo'])): echo $valorForm['processo'];
                    endif;
                    ?>" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="ano" class="col-sm-3 col-form-label">Ano</label>
                <div class="col-sm-9">
                    <select class="form-control  select-basic " name="ano" id="ano" required style="width: 100%;">
                        <option value="">Selecione</option>
                        <?php
                        for ($i=0; $i < date('y'); $i++) { 
                            if ($valorForm['ano'] == $anos) {
                                $selecionado = "selected";
                            }else {
                                $selecionado = "";
                            }
                            echo "<option value='$anos' $selecionado>$anos</option>";
                            $anos--; 
                        } 
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="estudante_idestudante" class="col-sm-3 col-form-label">Estudante</label>
                <div class="col-sm-9">
                    <?php if($estudanteId != NULL): ?>
                    <select class="form-control  select-basic " <?php  echo 'disabled'; ?> name="estudante_idestudante"
                        id="estudante_idestudante" required style="width: 100%;">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($estudantes as $estudante):
                            extract($estudante);
                            if ($estudanteId = $idestudante):
                                $selecionado = "selected";
                            else:
                                $selecionado = "";
                            endif;
                            echo "<option value='$idestudante' $selecionado>$nome</option>";
                        endforeach;
                        ?>
                    </select>
                    <?php else: ?>
                    <select class="form-control  select-basic "
                        name="estudante_idestudante" id="estudante_idestudante" required style="width: 100%;">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($estudantes as $estudante):
                            extract($estudante);
                            if ($valorForm['estudante_idestudante'] == $idestudante):
                                $selecionado = "selected";
                            else:
                                $selecionado = "";
                            endif;
                            echo "<option value='$idestudante' $selecionado>$nome</option>";
                        endforeach;
                        ?>
                    </select>
                    <?php endif; ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="curso_idcurso" class="col-sm-3 col-form-label">Classe/Curso</label>
                <div class="col-sm-9">
                    <select class="form-control  select-basic " name="curso_idcurso" id="curso_idcurso" required
                        style="width: 100%;">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($cursos as $curso):
                            extract($curso);
                            if ($valorForm['curso_idcurso'] == $idcurso):
                                $selecionado = "selected";
                            else:
                                $selecionado = "";
                            endif;
                            echo "<option value='$idcurso' $selecionado>$nome</option>";
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="periodo_idperiodo" class="col-sm-3 col-form-label">Período</label>
                <div class="col-sm-9">
                    <select class="form-control  select-basic " name="periodo_idperiodo" id="periodo_idperiodo" required
                        style="width: 100%;">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($periodos as $periodo):
                            extract($periodo);
                            if ($valorForm['periodo_idperiodo'] == $idperiodo):
                                $selecionado = "selected";
                            else:
                                $selecionado = "";
                            endif;
                            echo "<option value='$idperiodo' $selecionado>$nome</option>";
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="turma_idturma" class="col-sm-3 col-form-label">Turma</label>
                <div class="col-sm-9">
                    <select class="form-control  select-basic " name="turma_idturma" id="turma_idturma" required
                        style="width: 100%;">
                        <option value="">Selecione</option>
                        <?php
                        foreach ($turmas as $turma):
                            extract($turma);
                            if ($valorForm['turma_idturma'] == $idturma):
                                $selecionado = "selected";
                            else:
                                $selecionado = "";
                            endif;
                            echo "<option value='$idturma' $selecionado>$nome</option>";
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
            <input type="hidden" name="created" value="<?php echo date("Y-m-d H:i:s"); ?>">
            <input type="hidden" name="empresa_id" value="<?php echo $_SESSION['id_empresa']; ?>">
            <input type="hidden" name="basic-form" value="Dados">
            <?php if($estudanteId != NULL):?>
            <input type="hidden" name="estudante_idestudante" value="<?php echo $estudanteId; ?>">
            <?php endif; ?>

            <div class="form-group row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <button type="button" id='refresh' class="btn btn-primary btn-block"
                        onclick="enviarDados('<?php echo URL; ?>controle-inscricao/cadastrar/', 'basic-form')"
                        value="Salvar" name="basic-form">Salvar</button>
                </div>
            </div>
        </form>
    </div>
</div>