
<!-- Javascripts -->
<!-- Load pace first -->
<script src="<?php echo base_url('public2/plugins/core/pace/pace.min.js') ?>"></script>
<!-- Important javascript libs(put in all pages) -->
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script>
    window.jQuery || document.write('<script src="<?php echo base_url('public2/js/libs/jquery-2.1.1.min.js') ?>">\x3C/script>')
</script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
    window.jQuery || document.write('<script src="<?php echo base_url('public2/js/libs/jquery-ui-1.10.4.min.js') ?>">\x3C/script>')
</script>

<!--[if lt IE 9]>
<script type="text/javascript" src="js/libs/excanvas.min.js"></script>
<script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script type="text/javascript" src="js/libs/respond.min.js"></script>
<![endif]-->
<!-- Bootstrap plugins -->
<script src="<?php echo base_url('public2/js/bootstrap/bootstrap.js') ?>"></script>
<!-- Core plugins ( not remove ) -->
<script src="<?php echo base_url('public2/js/libs/modernizr.custom.js') ?>"></script>
<!-- Handle responsive view functions -->
<script src="<?php echo base_url('public2/js/jRespond.min.js') ?>"></script>
<!-- Custom scroll for sidebars,tables and etc. -->
<script src="<?php echo base_url('public2/plugins/core/slimscroll/jquery.slimscroll.min.js') ?>"></script>
<script src="<?php echo base_url('public2/plugins/core/slimscroll/jquery.slimscroll.horizontal.min.js') ?>"></script>
<!-- Remove click delay in touch -->
<script src="<?php echo base_url('public2/plugins/core/fastclick/fastclick.js') ?>"></script>
<!-- Increase jquery animation speed -->
<script src="<?php echo base_url('public2/plugins/core/velocity/jquery.velocity.min.js') ?>"></script>
<!-- Quick search plugin (fast search for many widgets) -->
<script src="<?php echo base_url('public2/plugins/core/quicksearch/jquery.quicksearch.js') ?>"></script>
<!-- Bootbox fast bootstrap modals -->
<script src="<?php echo base_url('public2/plugins/ui/bootbox/bootbox.js') ?>"></script>
<!-- Other plugins ( load only nessesary plugins for every page) -->
<script src="<?php echo base_url('public2/plugins/charts/sparklines/jquery.sparkline.js') ?>"></script>
<script src="<?php echo base_url('public2/js/jquery.dynamic.js') ?>"></script>
<script src="<?php echo base_url('public2/js/main.js') ?>"></script>
<script src="<?php // echo base_url('public2/js/pages/blank.js') ?>"></script>

<?php if (isset($scripts)) : ?>
    <?php foreach ($scripts as $script) : ?>
        <script src="<?php echo base_url('public2/' . $script) ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>