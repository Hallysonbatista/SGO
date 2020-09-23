<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Sao_Paulo');
$atividades = 0;
$endid = 0;
$analise = 0;
$rejeitadas = 0;
$executadas = 0;
$suspensas = 0;
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
//
?>
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
            <?php // $this->load->view("layout/_rightsidebar");   ?>
            <!-- End #right-sidebar -->
            <?php $this->load->view("layout/topoTitulo"); ?>

            <?php // $this->load->view("layout/quadrados");   ?>
            <!-- .page-content -->

            <!-- / .row -->
            <!-- Minha pagina -->
            <link href="<?php echo base_url('public2/css/select2.css') ?>" rel="stylesheet"/> <!-- Select2-->
            <script src="<?php echo base_url('public2/js/select2_full.js') ?>"></script> <!-- Select2-->

            <!-- Minha pagina -->

            <div class="col-lg-3 col-md-4">
                <!-- col-lg-4 start here -->

                <!-- End .panel -->
            </div>
            <!-- col-lg-4 end here -->
            <div class="col-lg-5 col-md-4">
                <!-- col-lg-4 start here -->
                <form method="post">
                    <div class="panel panel-primary">
                        <!-- Start .panel -->

                        <div class="panel-heading">
                            <h4 class="panel-title text-center">Atualização de Preventivas</h4>
                        </div>
                        <div class="panel-body">
                            <div class="form-group text-center">
                                <label for="endid">EndId</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-home fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control text-center" disabled name="endid" value="<?php echo $preventiva->endid ?>"/>
                                    <?php echo form_error('endid', '<span asp-validation-for="endid" class="text-danger">', '</span>') ?>
                                </div>
                                <input type="hidden" class="form-control text-center" name="endid" value="<?php echo $preventiva->endid ?>"/>
                            </div>
                            <div class="form-group text-center">
                                <label for="alvo">Alvo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check-square fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control text-center" disabled name="alvo" value="<?php echo $preventiva->alvo ?>"/>
                                    <?php echo form_error('alvo', '<span asp-validation-for="alvo" class="text-danger">', '</span>') ?>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <label for="dataexecucao">Data Execução</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar fa" aria-hidden="true"></i></span>
                                    <input type="date" class="form-control text-center" name="dataexecucao" value="<?php echo date($preventiva->dataexecucao) ?>"/>
                                </div>
                                <?php echo form_error('dataexecucao', '<span asp-validation-for="dataexecucao" class="text-danger">', '</span>') ?>
                            </div>
                            <div class="form-group text-center">
                                <label for="acompanhamento">Status da atividade</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-file-text-o fa" aria-hidden="true"></i></span>
                                    <select type="text" class="form-control text-center select2 multiple" name="acompanhamento"/>
                                    <option value="<?php echo $preventiva->statuscontratada ?>"><?php echo $preventiva->nomeacompanhamento ?></option>
                                    <?php foreach ($status as $key => $value) : ?>
                                        <option value="<?php echo $value->idacompanhamento ?>"><?php echo $value->nomeacompanhamento ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                    <?php echo form_error('acompanhamento', '<span asp-validation-for="acompanhamento" class="text-danger">', '</span>') ?>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <label for="usersid">Tecnico</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa"></i></span>
                                    <select type="text" class="form-control text-center select2 multiple" name="usersid"/>
                                    <option value="<?php echo $preventiva->idusuario ?>"><?php
                                        if ($preventiva->idusuario == 1) {
                                            echo '';
                                        } else {
                                            echo $preventiva->nomeusuario;
                                        }
                                        ?></option>
                                    <?php foreach ($tecnico as $key => $value) : ?>
                                        <option value="<?php echo $value->id ?>"><?php echo $value->username ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                    <?php echo form_error('usersid', '<span asp-validation-for="usersid" class="text-danger">', '</span>') ?>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <label for="observacoes">Observações</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa fa-comment text-info fa" aria-hidden="true"></i></span>
                                    <textarea class="form-control" name="observacoes"><?php if($preventiva->observacoes == 'Carregamento automático'){echo '';}else{echo $preventiva->observacoes;} ?></textarea>
                                    <?php echo form_error('observacoes', '<span asp-validation-for="observacoes" class="text-danger">', '</span>') ?>
                                </div>
                            </div>
                            <input type="hidden" class="form-control text-center" name="idpreventiva" value="<?php echo date($preventiva->idpreventiva) ?>"/>
                            <input type="hidden" class="form-control text-center" name="alvoPreventiva" value="<?php echo ($preventiva->alvo) ?>"/>
                            <!--<input type="text" name="idpreventiva" value="<?php echo $preventiva->idpreventiva ?>" />-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="Atualizar"></label>
                                <div class="col-md-8">
                                    <button class="btn btn-success" type="Submit">Atualizar</button>
                                    <a href="<?php echo base_url('preventiva') ?>" class="btn btn-danger">Cancelar</a>
                                </div>
                            </div> 

                        </div>                    
                    </div>
                </form>
                <!-- End .panel -->
            </div>
            <!-- col-lg-4 end here -->
            <div class="col-lg-4 col-md-4">
                <!-- col-lg-4 start here -->

            </div>
            <!--<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.css" rel="stylesheet"/>-->

            <style>
                .select2-selection__rendered {
                    line-height: 31px !important;
                }
                .select2-container .select2-selection--single {
                    height: 35px !important;
                }
                .select2-selection__arrow {
                    height: 34px !important;
                }

            </style>
            <script>
                $('.select2').select2({
                    tags: true,
                    maximumSelectionLength: 3,
                    width: '100%'

                });
            </script>
          
            <br></br>

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


<div id="editarPreventiva" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Atualizar Preventivas</h4>
                <button type="button" class="close" data-dismiss="modal" onclick="habilitar()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formListaPreventiva">
                    <div class="col-md-6 offset-md-3">
                        <div class="form-group" align = "center"> 
                            <input type="text" id="idPreventiva" hidden name="idPreventiva" class="form-control" value="">
                            <div class="form-group">
                                <label for="inpuMatricula">Endereço ID:</label>
                                <input type="text" id="endid" disabled name="endid" class="form-control" value="">
                                <span class="help-block invalid-feedback"></span>
                            </div>
                            <div class="form-group">
                                <label for="inpuMatricula">Alvo:</label>
                                <input type="text" id="alvo"align = "center"  disabled name="alvo" class="form-control" value="">
                                <span class="help-block invalid-feedback"></span>
                            </div>
                            <div class="form-group">
                                <label for="inpuMatricula">Classificação HQ:</label>
                                <input type="text" id="classhq" disabled name="classhq" class="form-control" value="">
                                <span class="help-block invalid-feedback"></span>
                            </div>
                            <div class="form-group">
                                <label for="inpuMatricula">Data Execução:</label>
                                <input type="date" style="text-align: center;" id="dataexecucao" name="dataexecucao" class="form-control" value="">
                                <span class="help-block invalid-feedback"></span>
                            </div>
                            <div class="form-group">
                                <label>Status:</label>
                                <select id="statuscontratada" name="statuscontratada" class="form-control  select2" style="width: 100%">
                                    <option value="Executada">Executada</option>
                                    <option value="Analise">Analise</option>
                                    <option value="Rejeitada">Rejeitada</option>
                                    <option value="Desativado">Desativado</option>
                                    <option value="Restrição de acesso">Restrição de acesso</option>
                                    <option value="Chuva">Chuva</option>
                                    <option value="Outros">Outros</option>
                                </select>
                                <span class="help-block invalid-feedback"></span>
                            </div>
                            <div class="form-group">
                                <label for="inputStatus">Técnico:</label>
                                <select id="usuario_idusuario" name="usuario_idusuario" class="form-control select2" style="width: 100%">
                                    <?= $tecnico ?>
                                </select>
                                <span class="help-block invalid-feedback"></span>
                            </div>
                            <div class="form-group">
                                <label for="inputObservacoes">Obs:</label>
                                <textarea type="date" style="text-align: center;" id="observacoes" name="observacoes" class="form-control" value=""></textarea>
                                <span class="help-block invalid-feedback"></span>
                            </div>
                            <div class="form-group col-md-4 mx-auto">
                                <button type="submit" name="salvar" id="salvar"  class="btn btn-primary">
                                    <i class="fa fa-save"></i>&nbsp;&nbsp;Salvar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



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