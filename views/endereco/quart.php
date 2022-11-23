<?php
if (isset($this->Dados)):
    $distritos = $this->Dados;
//var_dump($Carousels);
endif;
?>

<select class="form-control" name="quarteirao_id" required="">
   <option value="">Selecione o Quarteirão/Zona/Unidade/Povoado/Aldeia</option>
    <?php
    foreach ($distritos as $distrito):
        extract($distrito);
   
        echo "<option value='$id' $selecionado>$nome</option>";
    endforeach;
    ?>
</select> 
