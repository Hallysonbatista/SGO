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
            <?php if ($message = $this->session->flashdata('error')): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $message ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <?php if ($message = $this->session->flashdata('sucesso')): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $message ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <form class="form-horizontal" enctype="multipart/form-data" method="post">
                <fieldset>
                    <div class="panel panel-primary">
                        <div class="panel-heading"><?php echo $titulo ?></div>
                        <div class="panel-body">
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="data">Data:</label>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" id="data" name="data"/>  
                                    <?php echo form_error('data', '<span asp-validation-for="data" class="text-danger">', '</span>') ?>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="file">Arquivo:</label>
                                <div class="col-md-3">
                                    <input type="file" class="btn btn-primary btn-sm" id="file" name="file"/>                                
                                </div>
                            </div>
                            <div class="panel-body">
                                <!-- Text input-->
                                <div class="form-group">
                                    <!--<label class="col-md-2 control-label" for="Senha">Senha</label>-->  
                                    <div class="col-md-8">
                                        <label class="col-md-2 control-label" for="Gerar relatório"></label>
                                        <button class="btn btn-success" type="Submit">Cadastrar</button>
                                        <a href="<?php echo base_url() ?>Preventiva" class="btn btn-danger" type="">Cancelar</a>
                                            <!--<input name="password" value = ""   class="form-control input-md" type="password">-->

                                    </div>
                                </div>
                            </div>                         
                        </div>
                    </div>
                </fieldset>
            </form>


            <?php if ($message = $this->session->flashdata('errorPreventiva')): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $message ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <?php if (isset($preventivasNaoCarregar)): ?>
                <fieldset>
                    <div class="panel panel-danger">
                        <div class="panel-heading">Preventivas não cadastradas  !!!!!</div>
                        <div class="panel-body">

                            <table class="table table-dark">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">SGMP</th>
                                        <th scope="col">ENDID</th>
                                        <th scope="col">Contrato</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($preventivasNaoCarregar as $row => $value) : ?>
                                        <tr>
                                            <th scope="row"><?php echo $row +1 ?></th>
                                            <td><?php echo $value['sgmp'] ?></td>
                                            <td><?php echo $value['estacao_idestacao'] ?></td>
                                            <td><?php echo $value['contrato'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </fieldset>
            <?php endif; ?>

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