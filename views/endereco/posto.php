<?php
if (isset($this->Dados)):
    $distritos = $this->Dados;
//var_dump($Carousels);
endif;
?>

<select class="form-control" onchange="enviaDados('<?php echo URL; ?>/controle-busca/busca-local/', {id: this.value}, 'local')">
   <option value="">Selecione o Posto</option>
    <?php
    foreach ($distritos as $distrito):
        extract($distrito);
   
        echo "<option value='$id' $selecionado>$nome</option>";
    endforeach;
    ?>
</select> 
