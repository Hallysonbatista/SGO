<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Sao_Paulo');
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        var base_url = "<?php echo base_url() ?>";
        $('#regiao_idregiao').change(function () {
            $('#nomecm').attr('disabled', 'disabled');
            $('#nomecm').html("<option>Carregando...</option>");
            regiao_idregiao = $('#regiao_idregiao').val();
            $.post(base_url + 'ajax/preventiva/getCm', {
                regiao_idregiao: regiao_idregiao
            }, function (data) {
                $('#nomecm').html(data);
                $('#nomecm').removeAttr('disabled');
            });
        });
    });

</script>


//<?php
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
            <?php // $this->load->view("layout/_rightsidebar"); ?>
            <!-- End #right-sidebar -->
            <?php $this->load->view("layout/topoTitulo"); ?>

            <?php // $this->load->view("layout/quadrados"); ?>
            <!-- .page-content -->

            <!-- / .row -->
            <!-- Minha pagina -->


            <!-- Minha pagina -->

            <form class="form-horizontal" method="post" action="baixarRelatorio">
                <fieldset>
                    <div class="panel panel-primary">
                        <div class="panel-heading">Gerar relatório de preventivas</div>
                        <div class="panel-body">
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="regiao">Região:</label>
                                <div class="col-md-3">
                                    <select id="regiao_idregiao" name="regiao_idregiao" class="form-control">
                                        <option value=""></option>
                                        <?php echo $options_regiao; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="Cm">Cm:</label>
                                <div class="col-md-3">
                                    <select id="nomecm" name="nomecm" disabled class="form-control">          
                                        <option>Selecione o CM</option>
                                    </select>                                   
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="contrato">Relatorio com zeladoria?</label>
                                <div class="col-md-3">
                                    <select id="contrato" name="contrato" class="form-control">          
                                        <option value="">SIM</option>
                                        <option value="FMMT_Zeladoria" selected>Não</option>
                                    </select>                                   
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="mes">Mês:</label>
                                <div class="col-md-2">
                                    <select  class="form-control" name="mesProgramacao">
                                        <option value="<?= $mesAtual = date('M/Y'); ?>"><?= $mesAtual = date('M/Y'); ?></option>
                                        <?php echo $mes ?>
                                    </select>
                                </div>
                            </div>


                            <div class="panel-body">
                                <!-- Text input-->
                                <div class="form-group">
                                    <!--<label class="col-md-2 control-label" for="Senha">Senha</label>-->  
                                    <div class="col-md-8">
                                        <label class="col-md-2 control-label" for="Gerar relatório"></label>
                                        <button class="btn btn-success" type="Submit">Gerar relatório</button>
                                        <a href="<?php echo base_url() ?>Preventiva" class="btn btn-danger" type="">Cancelar</a>
                                            <!--<input name="password" value = ""   class="form-control input-md" type="password">-->

                                    </div>
                                </div>
                            </div>                         
                        </div>
                    </div>
                </fieldset>
            </form>



            <!-- FIM Minha pagina -->




            <!-- End .row -->
        </div>
        <!-- / .page-content-inner -->
    </div>
    <!-- / page-content-wrapper -->
</div>
<!-- / page-content -->

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