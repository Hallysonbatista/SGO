<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Sao_Paulo');
$atividades =0;
$endid =0;
$analise =0;
$rejeitadas =0;
$executadas =0;
$suspensas =0;
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!--<script type="text/javascript">
    $(function () {
        var base_url = "<?php echo base_url() ?>";
        $('#contrato').change(function () {
            $('#mesProgramacao').attr('disabled', 'disabled');
            $('#mesProgramacao').html("<option>Carregando...</option>");
            mesProgramacao = $('#contrato').val();
            $.post(base_url + 'ajax/preventiva/mesAcompanhamentoPreventiva', {
                mesProgramacao: mesProgramacao
            }, function (data) {
                $('#mesProgramacao').html(data);
                $('#mesProgramacao').removeAttr('disabled');
            });
        });
    });

</script>-->
<?php
//$mes = $this->session->userdata("mes");
//if ($mes == '') {
//    $mes = date('M/Y');
//}
//?>
<!doctype html>
<!--[if lt IE 8]><html class="no-js lt-ie8"> <![endif]-->
<html class="no-js">

    <body>
        <!--[if lt IE 9]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
        <!-- .page-navbar -->
        <?php $this->load->view("layout/_navbar"); ?>
        <!-- / page-navbar -->
        <!-- #wrapper -->
        <div id="wrapper">
            <!-- .page-sidebar -->
            <aside id="sidebar" class="page-sidebar hidden-md hidden-sm hidden-xs">
                <!-- Start .sidebar-inner -->
                <div class="sidebar-inner">
                    <!-- Start .sidebar-scrollarea -->
                    <div class="sidebar-scrollarea">
                        <!--  .sidebar-panel -->
                        <?php $this->load->view("layout/_profile_left_sidebar"); ?>

                        <!-- .side-nav -->
                        <div class="side-nav">
                            <ul class="nav">
                                <?php $this->load->view("layout/_lis_do_menu_left"); ?>
                            </ul>
                        </div>
                        <!-- / side-nav -->
                        <!--  .sidebar-panel -->
                        <?php $this->load->view("layout/_menu_inferior_left"); ?>
                    </div>
                    <!-- End .sidebar-scrollarea -->
                </div>
                <!-- End .sidebar-inner -->
            </aside>
            <!-- / page-sidebar -->
            <!-- Start #right-sidebar -->
            <?php // $this->load->view("layout/_rightsidebar");  ?>
            <!-- End #right-sidebar -->
            <?php $this->load->view("layout/topoTitulo"); ?>

            <?php // $this->load->view("layout/quadrados");  ?>
            <!-- .page-content -->

            <!-- / .row -->
            <!-- Minha pagina -->


            <!-- Minha pagina -->

            <form class="form-horizontal" method="post">
                <fieldset>
                    <div class="panel panel-primary">
                        <div class="panel-heading">Filtro</div>
                        <div class="panel-body">
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="contrato">Contrato:</label>
                                <div class="col-md-3">
                                    <select id="contrato" name="contrato" class="form-control">
                                        <option value="<?php echo $filtro ?>"><?php echo $filtro ?></option>
                                        <?php echo $contrato; ?>
                                    </select>
                                </div>

                                <label class="col-md-1 control-label" for="mesprogramacao">Mês:</label>
                                <div class="col-md-2">
                                    <select  class="form-control" id="mesprogramacao" name="mesprogramacao">
                                        <option value="<?php echo $mes ?>"><?php echo $mes ?></option>
                                        <?php echo $mesSelect ?>
                                    </select>
                                </div>
                            </div>


                            <div class="panel-body">
                                <!-- Text input-->
                                <div class="form-group">
                                    <!--<label class="col-md-2 control-label" for="Senha">Senha</label>-->  
                                    <div class="col-md-8">
                                        <label class="col-md-9 control-label" for="Gerar relatório"></label>
                                        <button class="btn btn-success" type="Submit">Filtrar</button>
                                    </div>
                                </div>
                            </div>                         
                        </div>
                    </div>
                </fieldset>
            </form>



            <div class="panel panel-primary">
                <div class="panel-heading"><?php echo 'Contrato&nbsp; =&nbsp;' . $filtro .'&nbsp;&nbsp/&nbsp;&nbsp;Mes&nbsp; =&nbsp;'.$mes; ?></div>
                <div class="panel-body">
                    <!-- Text input-->

                    <table id='minhaTabela' class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Região</th>
                                <th scope="col">Atividades</th>
                                <th scope="col">EndId</th>
                                <th scope="col">Analises</th>
                                <th scope="col">Rejeitadas</th>
                                <th scope="col">Executada</th>
                                <th scope="col">Suspensas</th>
                                <th scope="col">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;%</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($acompanhamento as $key => $value) :
                                $atividades = $atividades + $value->geral;
                                $endid = $endid + $value->endid;
                                $analise = $analise + $value->analise;
                                $rejeitadas = $rejeitadas + $value->rejeitada;
                                $executadas = $executadas + $value->aprovada;
                                $suspensas = $suspensas + $value->suspensa;
                                ?>

                                <tr>
                                    <td><?php echo $value->nomeregiao; ?></td>
                                    <td><?php echo $value->geral; ?></td>
                                    <td><?php echo $value->endid; ?></td>
                                    <td><?php echo $value->analise; ?></td>
                                    <td><?php echo $value->rejeitada; ?></td>
                                    <td><?php echo $value->aprovada; ?></td>
                                    <td><?php echo $value->suspensa; ?></td>
                                    <td><?php
                                        if ($endid == 0) {
                                            echo'-';
                                        } else {
                                            echo porcentagem($value->geral, ($value->analise + $value->aprovada + $value->suspensa));
                                        }
                                        ?>&nbsp;%</td>                                   
                                </tr>  
                                <?php endforeach; ?>
                            <tr>
                                <td> TSL</td>
                                <td><?php echo $atividades; ?></td>
                                <td><?php echo $endid; ?></td>
                                <td><?php echo $analise; ?></td>
                                <td><?php echo $rejeitadas; ?></td>
                                <td><?php echo $executadas; ?></td>
                                <td><?php echo $suspensas; ?></td>
                                <td><?php
                                    if ($endid == 0) {
                                        echo'-';
                                    } else {
                                        echo porcentagem($atividades, ($analise + $executadas + $suspensas));
                                    }
                                    ?>&nbsp;%</td>                                   
                            </tr>  
                        </tbody>
                    </table>
                    <br>

                </div>
            </div>
            <?php

            function porcentagem($total, $atual) {
                if ($total == 0 and $atual == 0) {
                    return 100;
                } elseif ($total == 0 and $atual != 0) {
                    return 'Verificar - ';
                } else {
                    $res = $atual * 100 / $total;
                    $porcentagem = number_format($res, 0, '.', ',');
                    return $porcentagem;
                }
            }
            ?>


            <script>
                var tabela = document.getElementById("minhaTabela");
                var linhas = tabela.getElementsByTagName("tr");

                for (var i = 0; i < linhas.length; i++) {
                    var linha = linhas[i];
                    linha.addEventListener("click", function () {
                        //Adicionar ao atual
                        selLinha(this, false); //Selecione apenas um
                        //selLinha(this, true); //Selecione quantos quiser
                    });
                }

                /**
                 Caso passe true, você pode selecionar multiplas linhas.
                 Caso passe false, você só pode selecionar uma linha por vez.
                 **/
                function selLinha(linha, multiplos) {
                    if (!multiplos) {
                        var linhas = linha.parentElement.getElementsByTagName("tr");
                        for (var i = 0; i < linhas.length; i++) {
                            var linha_ = linhas[i];
                            linha_.classList.remove("selecionado");
                        }
                    }
                    linha.classList.toggle("selecionado");
                }

                /**
                 Exemplo de como capturar os dados
                 **/
                var btnVisualizar = document.getElementById("visualizarDados");

                btnVisualizar.addEventListener("click", function () {
                    var selecionados = tabela.getElementsByClassName("selecionado");
                    //Verificar se eestá selecionado
                    if (selecionados.length < 1) {
                        alert("Selecione pelo menos uma linha");
                        return false;
                    }

                    var dados = "";

                    for (var i = 0; i < selecionados.length; i++) {
                        var selecionado = selecionados[i];
                        selecionado = selecionado.getElementsByTagName("td");
                        dados += "ID: " + selecionado[0].innerHTML + " - Nome: " + selecionado[1].innerHTML + " - Idade: " + selecionado[2].innerHTML + "\n";
                    }

                    alert(dados);
                });
            </script>
            <style>
                body{
                    font-family:sans-serif;  
                }

                #minhaTabela{
                    width:80%;
                    margin:0 auto;
                    border:0;
                    box-shadow: 0 5px 30px darkgrey;
                    border-spacing: 0;
                }

                #minhaTabela thead th{
                    font-weight: bold;
                    background-color: black;
                    color:white;

                    padding:5px 10px;
                }

                #minhaTabela tr td{
                    padding:5px 10px;
                    text-align: center;

                    cursor: pointer; /**importante para não mostrar cursor de texto**/
                }

                #minhaTabela tr td:last-child{
                    text-align: right;
                }

                /**Cores**/
                #minhaTabela tr:nth-child(odd){
                    background-color: #eee;
                }

                /**Cor quando passar por cima**/
                #minhaTabela tr:hover td{
                    background-color: #feffb7;
                }

                /**Cor quando selecionado**/
                #minhaTabela tr.selecionado td{
                    background-color: #aff7ff;
                }


                button#visualizarDados{
                    background-color: white;
                    border: 1px solid black;
                    width:50%;
                    margin: 10px auto;
                    padding:10px 0;
                    display: block;
                    color: black;
                }
            </style>


            <!-- FIM Minha pagina -->




            <!-- End .row -->
        </div>
        <!-- / .page-content-inner -->
    </div>
    <!-- / page-content-wrapper -->
</div>
<!-- / page-content -->
<br>
<!-- / #wrapper -->
<?php $this->load->view("layout/_footer"); ?>
<!-- End #footer  -->
<!-- Back to top -->
<div id="back-to-top"><a href="#">Back to Top</a>
</div>

</body>
</html>
<style>
    .pace {
        -webkit-pointer-events: none;
        pointer-events: none;

        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    .pace .pace-activity {
        display: block;
        position: fixed;
        z-index: 2000;
        top: 0;
        right: 0;
        width: 300px;
        height: 300px;
        background: #29d;
        -webkit-transition: -webkit-transform 0.1s;
        transition: transform 0.3s;
        -webkit-transform: translateX(100%) translateY(-100%) rotate(45deg);
        transform: translateX(100%) translateY(-100%) rotate(45deg);
        pointer-events: none;
    }

    .pace.pace-active .pace-activity {
        -webkit-transform: translateX(50%) translateY(-50%) rotate(45deg);
        transform: translateX(50%) translateY(-50%) rotate(45deg);
    }

    .pace .pace-activity::before,
    .pace .pace-activity::after {
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        position: absolute;
        bottom: 30px;
        left: 50%;
        display: block;
        border: 5px solid #fff;
        border-radius: 50%;
        content: '';
    }

    .pace .pace-activity::before {
        margin-left: -40px;
        width: 80px;
        height: 80px;
        border-right-color: rgba(0, 0, 0, .2);
        border-left-color: rgba(0, 0, 0, .2);
        -webkit-animation: pace-theme-corner-indicator-spin 3s linear infinite;
        animation: pace-theme-corner-indicator-spin 3s linear infinite;
    }

    .pace .pace-activity::after {
        bottom: 50px;
        margin-left: -20px;
        width: 40px;
        height: 40px;
        border-top-color: rgba(0, 0, 0, .2);
        border-bottom-color: rgba(0, 0, 0, .2);
        -webkit-animation: pace-theme-corner-indicator-spin 1s linear infinite;
        animation: pace-theme-corner-indicator-spin 1s linear infinite;
    }

    @-webkit-keyframes pace-theme-corner-indicator-spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(359deg); }
    }
    @keyframes pace-theme-corner-indicator-spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(359deg); }
    }


</style>