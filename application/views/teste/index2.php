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
                        <!--  .sidebar-panel -->
                        <div class="sidebar-panel">
                            <h5 class="sidebar-panel-title">Navigation</h5>
                        </div>
                        <!-- / .sidebar-panel -->
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
            <?php $this->load->view("layout/_rightsidebar"); ?>
            <!-- End #right-sidebar -->
            <!-- .page-content -->
           <?php $this->load->view("layout/topoTitulo"); ?>
           
             <?php // $this->load->view("layout/quadrados"); ?>
            
             <div class="alert alert-danger" role="alert">
                <strong>Atenção!</strong> <?php echo $this->session->flashdata('info') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- FIM Minha pagina -->
            <!-- End .row -->
        </div>
        <!-- / .page-content-inner -->
    </div>
    <!-- / page-content-wrapper -->
</div>
            <!-- / page-content -->
        </div>
        <!-- / #wrapper -->

        <?php $this->load->view("layout/_footer"); ?>
        <!-- End #footer  -->
        <!-- Back to top -->
        <div id="back-to-top"><a href="#">Back to Top</a>
        </div>
        <!-- Javascripts -->
        <!-- Load pace first -->

    </body>
</html>



