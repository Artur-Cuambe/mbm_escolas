<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="content-heading">
            <div class="heading-left">
                <h1 class="page-title">Listar Ordem do Menu</h1>
                <p class="page-subtitle"></p>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Parent</a></li>
                    <li class="breadcrumb-item active">Current</li>
                </ol>
            </nav>
        </div>

        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Registo de níveis de acesso</h3>
                    <div class="right">
                        <a href="<?php echo URL; ?>controle-login/listar-classe-methodo"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-lock"></i> Permissões </button></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php
                        if (isset($_SESSION['msg'])):
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        endif;
                        if (isset($_SESSION['msgcad'])):
                            echo $_SESSION['msgcad'];
                            unset($_SESSION['msgcad']);
                        endif;

                        if (isset($this->Dados)):
                            $Menus = $this->Dados;
                        endif;
                        ?>
                        <?php
                        if (!empty($this->Dados)):
                            ?>
                            <table id="datatable-basic" class="table table-hover table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="hidden-xs">ID</th>
                                        <th class="hidden-xs">Classe</th>
                                        <th class="hidden-xs">Método</th>
                                        <th>Página</th>
                                        <th class="hidden-xs">Status</th>
                                        <th class="hidden-xs">Status Menu</th>
                                        <th>Ordem</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $qnt_linhas_exe = 1;
                                    foreach ($Menus as $Menu) :
                                        extract($Menu);
                                        $nome_permissao = ($situacao_permissao == 1 ) ? "<span class='label label-success'>Liberado</span>" : "<span class='label label-danger'>Bloqueado</span>";

                                        $menu = ($menu == 1 ) ? "<a href='" . URL . "controle-menu/editar/$id'><button type='button' class='btn btn-xs btn-primary'><i class='fa fa-unlock'></i> Menu</button></a>" : "<a href='" . URL . "controle-menu/editar/$id'><button type='button' class='btn btn-xs btn-danger'><i class='fa fa-lock'></i> Menu</button></a>";
                                        ?>               
                                        <tr>
                                            <td class="hidden-xs"><?php echo $id; ?></td>
                                            <td class="hidden-xs"><?php echo $nome_classe; ?></td>
                                            <td class="hidden-xs"><?php echo $nome_method; ?></td>
                                            <td><?php echo $nome_menu; ?></td>
                                            <td class="hidden-xs"><?php echo $nome_permissao; ?></td>
                                            <td class="hidden-xs"><?php echo $menu; ?></td>
                                            <td><?php echo $ordem; ?></td>
                                            <td>
                                                <?php
                                                if ($qnt_linhas_exe == 1):
                                                    echo "<button type='button' class='btn btn-xs btn-dark'>";
                                                    echo "<span class='fa fa-arrow-up'></span>";
                                                    echo "</button>";
                                                else:
                                                    echo "<a href='" . URL . "controle-menu/editarOrdem/$id'><button type='button' class='btn btn-xs btn-dark'>";
                                                    echo "<span class='fa fa-arrow-up'></span>";
                                                    echo "</button></a>";
                                                endif;
                                                ?>
                                            </td>
                                        </tr>

                                        <?php
                                        $qnt_linhas_exe++;
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                            <?php
                        endif;

                        //var_dump($this->Dados);
                        ?>
                    </div>
                </div>
            </div>
            <!-- END BASIC DATATABLE -->
        </div>
    </div>
</div>