<?php
if (isset($this->Menu[1])):
    $notificacao = $this->Menu[1];
//   var_dump($notificacao);
endif;
if (isset($this->Menu[2])):
    $nivel = $this->Menu[2];
// var_dump($nivel[0]);
endif;
?>
<div id="left" class=" left">
    <div class="media user-media well-small">
        <a class="user-link"   >
            <!--<img class="media-object img-thumbnail user-img" alt="User Picture" src="assets/img/user.gif" />-->
            <?php
            $foto = URL . "assets/imagens/usuarios/" . $_SESSION['id'] . "/" . $_SESSION['foto'];
            if (!empty($_SESSION['foto'])):
                echo "<img src='$foto' class='media-object img-thumbnail user-img' width='60' alt='Avatar'>";
            else:
                $foto = URL . "assets/imagens/adm/icone-usuario.png";

                echo "<img src='$foto'  class='media-object img-thumbnail user-img' width='60' alt='Avatar'>";
            endif;
            ?>
        </a>
        <br />
        <div class="media-body">
            <h5 class="media-heading"><?php echo current(str_word_count($_SESSION['name'], 2)); ?></h5>
            <ul class="list-unstyled user-info">

                <li>
                    <a class="btn btn-success btn-xs btn-circle" style="width: 6px; height: 10px;"></a> 
                    <?php echo $nivel[0]['nome_niveis_acesso']; ?>
                </li>

            </ul>
        </div>
        <br />
    </div>

    <ul id="menu" class="collapse panel">
        <?php
        $i = 0;
        foreach ($this->Menu[0] as $item_menu) :

            $i++;
            $expand = "";
            $menuItem = $item_menu['nome_menu'];
            $nome_classe = $item_menu['nome_classe'];
            $nome_method = $item_menu['nome_method'];
            $icone = $item_menu['icon'];
            $link = explode("/", $_GET['url']);
            // var_dump($_GET['url']);
            ?> 
            <?php
            if ($link[0] == $nome_classe) {
                if ($nome_classe == 'controle-home') {
                    ?>
                    <li class="panel active"><a href="<?= URL . $nome_classe . '/' . $nome_method ?>"  ><i class="<?= $icone ?>"> </i>  <?= $item_menu['nome_menu'] ?></a></li>

                <?php } else { ?>
                    <li class="panel  ">

                        <a href="#" data-parent="#" onclick="" data-toggle="" id="<?= $item_menu['id'] ?>" class="accordion-toggle" style='color: #ffff00' data-target="#<?= $item_menu['id'] ?>">
                            <i class="<?= $icone ?>"> </i>  <?= $item_menu['nome_menu'] ?> 
                        </a>

                        <ul class="collapsed" id="<?= $item_menu['id'] ?>" onclick="alert('ola')">  
                            <?= "<li class=''><a  href='" . URL . "$nome_classe/$nome_method'  ><i class='icon-list-ul'></i> $menuItem</a></li>" ?>


                        </ul>
                    </li>
                    <?php
                }
            } else {

                if ($nome_classe == 'controle-home') {
                    ?>

                    <li class="panel "><a href="<?= URL . $nome_classe . '/' . $nome_method ?>"  ><i class="<?= $icone ?>"> </i>  <?= $item_menu['nome_menu'] ?></a></li>

                <?php } else { ?>
                    <li class="panel ">

                        <a href="#" data-parent="#menu" data-toggle="collapse" class="accordion-toggle" data-target="#<?= $item_menu['id'] ?>">
                            <i class="<?= $icone ?>"> </i>  <?= $item_menu['nome_menu'] ?>  

                            <span class="pull-right">
                                <i class="icon-angle-left"></i>
                            </span>
                        </a>


                        <ul class="collapse" id="<?= $item_menu['id'] ?>" onclick="enviaDados('<?=URL.$nome_classe.'/'.$nome_method?>',null,'content')">  
                            <?= "<li class=''><a style='color:' href='#'><i class='icon-list-ul'></i> Listar $menuItem</a></li>" ?>
                        </ul>
                    </li>
                <?php } ?>
            <?php } ?>


            <?php
        endforeach;
        ?>
    </ul>

</div>

<!--END MENU SECTION -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="" id="respostaModal">

        </div>
    </div>
</div>

