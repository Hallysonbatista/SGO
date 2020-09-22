<div class="page-content sidebar-page right-sidebar-page clearfix">
    <!-- .page-content-wrapper -->
    <div class="page-content-wrapper">
        <div class="page-content-inner">
            <!-- .page-content-inner -->
            <div id="page-header" class="clearfix">
                <div class="page-header">
                    <h2><?php echo $titulo?></h2>
                    <?php if(isset($atualizacao)) :?>
                    <span class="badge badge-pill badge-danger"><?php echo 'ultima atualização: '.date_format(new DateTime($atualizacao->atualizacao), 'd/m/Y H:i:s'); ?></span
                    <p class="text-dark" ></p>
                    <?php endif; ?>
                </div>
<!--                <div class="header-stats">
                    <div class="spark clearfix">
                        <div class="spark-info"><span class="number">2345</span>Visitors</div>
                        <div id="spark-visitors" class="sparkline"></div>
                    </div>
                    <div class="spark clearfix">
                        <div class="spark-info"><span class="number">17345</span>Views</div>
                        <div id="spark-templateviews" class="sparkline"></div>
                    </div>
                    <div class="spark clearfix">
                        <div class="spark-info"><span class="number">3700$</span>Sales</div>
                        <div id="spark-sales" class="sparkline"></div>
                    </div>
                </div>-->
            </div>
            <!--quadrados de informações-->
            
            
            <!-- / .row -->
            <!-- Minha pagina -->

           