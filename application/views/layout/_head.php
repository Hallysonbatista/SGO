

<head>
    <meta charset="utf-8">
    <title><?php echo $tituloSuperior;?></title>
    <!-- Mobile specific metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1 user-scalable=no">
    <!-- Force IE9 to render in normal mode -->
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <meta name="author" content="" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="application-name" content="" />


    <!-- Import google fonts - Heading first/ text second -->
    <link href='http://fonts.googleapis.com/css?family=Quattrocento+Sans:400,700' rel='stylesheet' type='text/css'>

    <link href="<?php echo base_url('public2/css/icons.css') ?>" rel="stylesheet" />

    <!--Bootstrap stylesheets (included template modifications)--> 
    <link href="<?php echo base_url('public2/css/bootstrap.css') ?>" rel="stylesheet" />

    <!--Plugins stylesheets (all plugin custom css)--> 
    <!--<link href="<?php echo base_url('public2/css/plugins.css') ?>" rel="stylesheet" />-->
    <!--Main stylesheets (template main css file)--> 
    <link href="<?php echo base_url('public2/css/main.css') ?>" rel="stylesheet" />
    
    <!--Custom stylesheets ( Put your own changes here )--> 
   <!--<link href="<?php echo base_url('public2/css/custom.css') ?>" rel="stylesheet" />-->
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url('public/img/ico/apple-touch-icon-144-precomposed.png') ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url('public/img/ico/apple-touch-icon-114-precomposed.png') ?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url('public/img/ico/apple-touch-icon-72-precomposed.png') ?>">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url('public/img/ico/apple-touch-icon-57-precomposed.png') ?>">
    <link rel="icon" href="<?php echo base_url('public/img/ico/favicon.ico') ?>" href="<?php echo base_url('public/image/png') ?>">
    <!-- Windows8 touch icon ( http://www.buildmypinnedsite.com/ )-->
    <meta name="msapplication-TileColor" content="#3399cc" />

    <script src="<?php echo base_url('public/js/sweetalert2.all.min.js'); ?>" type="text/javascript"></script>

    <?php if (isset($styles)) : ?>
        <?php foreach ($styles as $style) : ?>
            <link href="<?php echo base_url('public/' . $style) ?>" rel="stylesheet" />
        <?php endforeach; ?>
    <?php endif; ?>
</head>