<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$nivelAcesso = $this->session->userdata("nAcesso");

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ezentis - TSL</title>
    <link href="<?= base_url() ?>public/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url(); ?>public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
    <!-- <link rel="stylesheet" type="text/css" href="css/select2.css"> -->
    <!-- <link href="<?= base_url() ?>public/css/bootstrap-datetimepicker.min.css" rel="stylesheet">  -->
    <script src="<?php echo base_url(); ?>public/vendor/jquery/jquery-3.1.1.min.js"></script>
    <!-- <script src="<?php echo base_url(); ?>public/js/select2.js"></script> -->
<!--     <link href="<?= base_url() ?>public/css/bootstrap-datetimepicker.min.css" rel="stylesheet"> -->
    <!-- Custom styles for this template-->

        <!--
        script graficos        
    -->
    <?php
    if (isset($styles)) {
        foreach ($styles as $style_name) {
            $href = base_url() . "/public/css/" . $style_name;
            ?>
            <link href="<?= $href ?>" rel="stylesheet">
            <?php
        }
    }
    ?>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="img-profile">
                    <img src="public/img/ezentis.png" width="110%" height="90%" />
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <br></br><br>
            <!-- Nav Item - Dashboard -->
            <!-- <li class="nav-item active"> -->
                <!-- <a class="nav-link" href="index.html"> -->
                    <!-- <i class="fas fa-fw fa-tachometer-alt"></i> -->
                    <!-- <span>Dashboard</span></a> -->
                </li>
                <!-- Divider -->
                <hr class="sidebar-divider">
                <!-- Heading -->
                <div class="sidebar-heading">
                    Menu
                </div>
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fa fa-user"></i>
                        <span>Usuários</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">                            
                            <a class="collapse-item" href="listarUsuario">Listar</a> 
                            <a class="collapse-item" href="CadastrarUsuario">Cadastrar</a>
                        </div>
                    </div>
                </li>
                                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEstacao" aria-expanded="true" aria-controls="collapseEstacao">
                        <i class="fa fa-user"></i>
                        <span>Estações</span>
                    </a>
                    <div id="collapseEstacao" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">                            
                            <a class="collapse-item" href="listarEstacao">Listar</a> 
                            <a class="collapse-item" href="cadastrarEstacao">Cadastrar</a>
                        </div>
                    </div>
                </li>
                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePreventiva" aria-expanded="true" aria-controls="collapsePreventiva">
                        <i class="fa fa-check-square"></i>
                        <span>Preventivas</span>
                    </a>
                    <div id="collapsePreventiva" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="batimentoTim">Batidão</a>
                            <a class="collapse-item" href="acompanhamento">Acompanhamento</a>
                            <a class="collapse-item" href="list-preventiva">Listar Preventivas</a>
                            <a class="collapse-item" href="telaAtualizaStatus">Atualizar Status</a>
                            <a class="collapse-item" href="cargaUnicaPreventiva">Cadastrar Preventiva</a>
                            <a class="collapse-item" href="cadastroMassivo">Carga Massiva</a>
                            <!-- <a class="collapse-item" href="historicopreventiva">Histórico</a> -->
                        </div>
                    </div>
                </li>
               <!--  <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTPend" aria-expanded="true" aria-controls="collapseTPend">
                        <i class="fa fa-book"></i>
                        <span>Pendências</span>
                    </a>
                    <div id="collapseTPend" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">                          
                            <a class="collapse-item" href="validarPendencia">Validar Pendência</a> 
                            <a class="collapse-item" href="acompanharPendencia ">Acompanhar Pendência</a>    
                            <a class="collapse-item" href="CadastrarUsuario">Encerrar Pendência</a>
                        </div>
                    </div>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCSM" aria-expanded="true" aria-controls="collapseCSM">
                        <i class="fa fa-cogs"></i>
                        <span>CSM</span>
                    </a>
                    <div id="collapseCSM" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <a class="collapse-item" href="ntts">NTT's</a>
                            <a class="collapse-item" href="utilities-border.html">Listar Preventivas</a>
                            <a class="collapse-item" href="utilities-animation.html">Atualizar Status</a>
                            <a class="collapse-item" href="utilities-other.html">Cadastrar Preventiva</a>
                            <a class="collapse-item" href="utilities-other.html">Carga Massiva</a>

                        </div>
                    </div>
                </li>
 -->


                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                        <section class="content-header">
                            <h2>
                                <small><?= $resumo ?></small>
                            </h2>
                        </section>
                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <!-- Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                            <!-- direciona o usuario para direita -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown"></div>

                            <div class="topbar-divider d-none d-sm-block"></div>

                            <!-- Nav Item - Usuario -->
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata("user_id") ?></span>
                                    <!--   <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">-->
                                </a>
                                <!-- Dropdown - User Information --> 
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                    <a href="" class="dropdown-item" id="perfil">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Perfil
                                    </a> 
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Sair
                                    </a>
                                </div>
                            </li>

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content fim top-->