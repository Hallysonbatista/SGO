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

            <!-- End #right-sidebar -->
            <!-- .page-content -->
            <?php $this->load->view("layout/topoTitulo"); ?>

            <?php // $this->load->view("layout/quadrados"); ?>
            <!-- / .row -->
            <!-- Minha pagina -->
            <?php if ($this->session->set_flashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <strong>Atenção!</strong> <?php echo $message ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>


            <!-- Minha pagina -->

            <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.css" rel="stylesheet"/>
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.js"></script>

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
                            <h4 class="panel-title text-center">Atualizar Estação</h4>
                        </div>
                        <div class="panel-body">
                            <div class="form-group text-center">
                                <label for="endid">EndId</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-home fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control text-center" disabled name="endid" value="<?php echo $estacao->endid ?>"/>
                                    <?php echo form_error('endid', '<span asp-validation-for="endid" class="text-danger">', '</span>') ?>
                                </div>
                                <input type="hidden" name="endid" value="<?php echo $estacao->endid ?>"/>
                            </div>

                            <?php if ($perfil_usuario_logado->id != 5) { ?>
                                <div class="form-group text-center">
                                    <label for="cm">Cm</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-group fa"></i></span>
                                        <select type="text" class="form-control text-center select2" name="cm_idcm"/>
                                        <option value="<?php echo $estacao->cm_idcm ?>"><?php echo $estacao->nomecm ?></option>
                                        <?php foreach ($cm as $key => $value) : ?>
                                            <option value="<?php echo $value->idcm ?>"><?php echo $value->nomecm ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('cm', '<span asp-validation-for="cm" class="text-danger">', '</span>') ?>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <label for="cidade">Cidade</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-globe fa"></i></span>
                                        <select type="text" class="form-control text-center select2" name="cidade"/>
                                        <option value="<?php echo $estacao->idcidade ?>"><?php echo $estacao->cidade ?></option>
                                        <?php foreach ($cidade as $key => $value) : ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->cidade ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('cidade', '<span asp-validation-for="cidade" class="text-danger">', '</span>') ?>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="form-group text-center">
                                    <label for="cm">Cm</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-group fa"></i></span>
                                        <select type="text" disabled class="form-control text-center select2" name=""/>
                                        <option value="<?php echo $estacao->idestacao ?>"><?php echo $estacao->nomecm ?></option>
                                        </select>
                                        <?php echo form_error('cm', '<span asp-validation-for="cm" class="text-danger">', '</span>') ?>
                                    </div>
                                </div>

                                <div class="form-group text-center">
                                    <label for="cidade">Cidade</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-globe fa"></i></span>
                                        <select type="text" disabled class="form-control text-center select2" name=""/>
                                        <option value="<?php echo $estacao->idcidade ?>"><?php echo $estacao->cidade ?></option>
                                        </select>
                                        <?php echo form_error('cidade', '<span asp-validation-for="cidade" class="text-danger">', '</span>') ?>
                                    </div>
                                </div>

                            <?php }; ?>
                            <div class="form-group text-center">
                                <label for="codigoenergia">Código de energia</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-plug fa" aria-hidden="true"></i></span>
                                    <input type="text" class="form-control text-center" name="codigoenergia" value="<?php echo $estacao->codigoenergia ?>"/>
                                    <?php echo form_error('codigoenergia', '<span asp-validation-for="codigoenergia" class="text-danger">', '</span>') ?>
                                </div>
                            </div>
                            <input type="hidden" name="idestacao" value="<?php echo $estacao->idestacao; ?>">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="Atualizar"></label>
                                <div class="col-md-8">
                                    <button class="btn btn-success" type="Submit">Atualizar</button>
                                    <a href="<?php echo base_url('estacao') ?>" class="btn btn-danger">Cancelar</a>
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


            <!-- FIM Minha pagina -->


            <!-- End .row -->
        </div>
        <!-- / .page-content-inner -->
    </div>
    <!-- / page-content-wrapper -->
</div>
<!-- / page-content -->
</div>
</div>
</div>
<!-- / #wrapper -->
<?php $this->load->view("layout/_footer"); ?>
<!-- End #footer  -->
<!-- Back to top -->
<div id="back-to-top"><a href="#">Back to Top</a>
</div>
<!-- Javascripts -->
<!-- Load pace first -->