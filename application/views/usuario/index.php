<!doctype html>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css"/>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>

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
            <?php $this->load->view("layout/topoTitulo"); ?>

            <?php // $this->load->view("layout/quadrados"); ?>
            <!-- .page-content -->

            <!-- / .row -->
            <!-- Minha pagina -->


            <!-- Minha pagina -->
            <?php if ($message = $this->session->flashdata('error')): ?>
                <?php
                echo "<script type='text/javascript'>
                Swal.fire({
                type: 'error',
		title: 'Oops...',
		text: '$message',
		showConfirmButton: true,
            });
	</script>";
                ?>

            <?php endif; ?>
            <?php if ($message = $this->session->flashdata('sucesso')): ?>
                <?php
                echo "<script type='text/javascript'>
                Swal.fire({
                type: 'success',
		title: 'Sucesso',
		text: '$message',
		showConfirmButton: true,
            });
	</script>";
                ?>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-12">

                    <div class="panel panel-default plain toggle panelMove panelClose panelRefresh">

                        <div class="panel-heading">
                            <h4 class="panel-title"></h4>
                        </div>
                        <div class="panel panel-default plain toggle panelMove panelClose panelRefresh">
                            <!-- Start .panel -->
                            <div class="panel-body">
                                <div style="overflow: auto;"><br>
                                    <div class="panel-body">
                                        <table class="table-striped table-bordered basic-datatables" cellspacing="0"  style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Usuário</th>
                                                    <th>E-mail</th>
                                                    <th>Ativo</th>
                                                    <th>Perfil</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($usuarios as $user): ?>
                                                    <tr>
                                                        <td><?php echo $user->id ?></td>
                                                        <td><?php echo $user->username ?></td>
                                                        <td><?php echo $user->email ?></td>
                                                        <td><?php if($user->active == 0){echo 'DESLIGADO';}elseif ($user->active == 1) {    echo 'NÃO';  }else{echo 'SIM';} ?></td>
                                                        <td><?php echo $this->ion_auth->get_users_groups($user->id)->row()->description ?></td>
                                                        <td>
                                                            <a href="<?php echo base_url("Usuario/edit/" . $user->id); ?>" title="Editar" class="btn btn-primary"><i class="fa fa-edit"></i> </a>
                                                            <!--<a href="" title="Excluir" class="btn btn-danger"><i class="fa fa-times"></i> </a>-->
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br></br>



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

</body>
</html>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return 'Details for ' + data[0] + ' ' + data[1];
                        }
                    }),
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll()
                }
            }
        });
    });
</script>
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