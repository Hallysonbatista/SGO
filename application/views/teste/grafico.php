<?php
$mes = $this->session->userdata("mes");
if ($mes == '') {
    $mes = date('M/Y');
}
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
            <?php // $this->load->view("layout/_rightsidebar"); ?>
            <!-- End #right-sidebar -->
            <?php $this->load->view("layout/topoTitulo"); ?>

            <?php // $this->load->view("layout/quadrados"); ?>
            <!-- .page-content -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script> comment 

            <!-- / .row -->
            <!-- Minha pagina -->

            <!-- .page-content-wrapper -->

            <!-- Start .page-content-inner -->
            <!-- Start .row -->
            <div class="row">
                <div class="col-lg-6">
                    <!-- col-lg-6 start here -->

                    <canvas id="primeiroGrafico"></canvas>
                    <!-- End .panel -->
                </div>
                <!-- col-lg-6 end here -->
                <div class="col-lg-6">
                    <!-- col-lg-6 start here -->
                    <canvas id="Grafico"></canvas>
                    <!-- End .panel -->
                </div>
                <!-- col-lg-6 end here -->
            </div>
            <!-- End .row -->
            <!-- End .page-content-inner -->
            <!-- / page-content-wrapper -->
            <!-- / page-content -->



            <script>
                let primeiroGrafico = document.getElementById('primeiroGrafico').getContext('2d');

                let chart = new Chart(primeiroGrafico, {
                    type: 'line',

                    data: {
                        labels: ['2000', '2001', '2002', '2003', '2004', '2005'],

                        datasets: [
                            {
                                label: 'Crecimento Populacional',
                                data: [173448346, 175885229, 178276128, 180619108, 182911487, 173448346]
                            }
                        ]
                    }
                });
            </script>

            <script>
                let Grafico = document.getElementById('Grafico').getContext('2d');

                let chart1 = new Chart(Grafico, {
                    type: 'line'
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

<!-- / #wrapper -->
<?php $this->load->view("layout/_footer"); ?>
<!-- End #footer  -->
<!-- Back to top -->
<div id="back-to-top"><a href="#">Back to Top</a>
</div>

</body>
</html>


