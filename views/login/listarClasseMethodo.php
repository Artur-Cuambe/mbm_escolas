<!--<div id="content" >-->

<div class="inner" >
        <div class="row">
            <div class="col-lg-12">
                <h2>Permissões registadas</h2>
            </div>
        </div>

        <hr />

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Listando Permissões de Acesso 
                        <div class="pull-right" style="margin-top: -5px;">
                            <p>
                                <a href="#" onclick="enviaDados('<?php echo URL; ?>controle-niveis-acesso/index/',null,'content')" ><button type="button" class="btn btn-primary btn-sm btn-rect  btn-grad"><i class='icon-cogs'></i> Niveis de Acesso </button></a>
                                <a href="#" onclick="enviaDados('<?php echo URL; ?>controle-login/cadastrar-classe',null,'content')" ><button type="button" class="btn btn-warning btn-sm btn-rect  btn-grad"><i class='icon-refresh'></i> Sincronizar</button></a>
                            </p>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php
                        if (isset($_SESSION['msg'])):
                            echo $_SESSION['msg'];
                            unset($_SESSION['msg']);
                        endif;
                        if (isset($_SESSION['msgcad'])):
                            echo $_SESSION['msgcad'];
                            unset($_SESSION['msgcad']);
                        endif;

                        $niveisAcessos = $this->Dados[1];
                        $this->Dados = $this->Dados[0];
                        if (!empty($this->Dados)):
                            $cont_niveis_acesso = 1;
                            $quant_niveis_acesso = 0;
                            ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Classe - Método</th>
                                            <?php
                                              foreach ($niveisAcessos as $nivelAcesso):
                                                extract($nivelAcesso);
                                                $ord_menu = URL . 'controle-menu/index/' . $id;
                                                echo "<th class='hidden-xs'> $nome_niveis_acesso <a onclick=\"enviaDados('$ord_menu', null, 'content')\"><button type='button' class='btn btn-xs btn-info'>Ordenar menu</button></a></th>";
                                                $quant_niveis_acesso++;
                                            endforeach;
                                            ?>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($this->Dados as $permissoes) :
                                            extract($permissoes);
                                            $nome_permissao = ($situacao_permissao == 1 ) ? "<span class='label label-success'>Liberado</span>" : "<span class='label label-danger'>Bloqueado</span>";

                                            $menu = ($menu == 1 ) ? "<a onclick=\"enviaDados('" . URL . "controle-menu/editar/$id',null,'content')\" href='#'><button type='button' class='btn btn-xs btn-success  btn-grad'>Menu</button></a>" : "<a onclick=\"enviaDados('" . URL . "controle-menu/editar/$id',null,'content')\" href='#'><button type='button' class='btn btn-xs btn-danger  btn-grad'>Menu</button></a>";
                                            //echo "Situacao da permissão: $nome_permissao <br>";

                                            if ($cont_niveis_acesso == 1):
                                                echo "<tr><td><b>" . $classes . "</b> - " . $methodos . "</td>";
                                                echo "<td class='hidden-xs'>" . $nome_permissao;
                                                echo " - " . $menu . "</td>";
                                                $cont_niveis_acesso++;

                                            elseif ($cont_niveis_acesso == $quant_niveis_acesso):

                                                echo "<td class='hidden-xs'>" . $nome_permissao;
                                                echo " - " . $menu . "</td>";
                                                echo "<td>";
                                                $url_destino = URL . "controle-login/editar-permissao/$methodo_id";
                                                $editar_url = URL . "controle-methodo/editar/" . $methodo_id;
                                                echo "<a onclick=\"chamarTela('$editar_url')\" href='#'><button type='button' class='btn btn-xs btn-primary  btn-grad'><i class='fa fa-edit'></i> Editar Menu</button></a> ";
                                                echo "<a onclick=\"chamarTela('$url_destino')\"href='#'><button type='button' class='btn btn-xs btn-warning  btn-grad'><i class='fa fa-edit'></i> Editar Permissão</button></a>";
                                                echo "</td>";
                                                echo "</tr>";
                                                $cont_niveis_acesso = 1;
                                            else:
                                                echo "<td class='hidden-xs'>" . $nome_permissao;
                                                echo " - " . $menu . "</td>";
                                                $cont_niveis_acesso++;
                                            endif;

                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        endif;

                        //var_dump($this->Dados);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script> $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });</script>


<!--</div>-->