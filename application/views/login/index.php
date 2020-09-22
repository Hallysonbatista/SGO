<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<link href="<?php echo base_url('public2/login/bootstrap.css') ?>" rel="stylesheet" />
<html>
    <head>
        <title>Acesso SOG</title>
        <style>
            body {

                background-image: url('<?php echo base_url('public2/login/telecomunicacoes.jpg') ?>');
                background-size: cover;
            }

            .panel-default {

                opacity: 1;
                margin-top: 30px;
            }

            .form-group.last {
                margin-bottom: 0px;
            } 
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span class="glyphicon glyphicon-lock"></span> Liberação SGO
                        </div>
                        <div class="panel-body">
                            <div class="text-primary" asp-validation-summary="ModelOnly"></div>
                            <form class="form-horizontal" method="post" name="form_auth" action="<?php echo base_url('Login/auth'); ?>">
                                <?php if ($message = $this->session->flashdata('error')) : ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $message ?>
                                    </div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">
                                        Usuário
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="text" name="usuario" required value="<?php echo set_value('usuario'); ?>" class="form-control ">
                                        <?php echo form_error('usuario', '<span class="alert-warning">', '</span>') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">
                                        Senha
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="password" name="Senha" class="form-control">
                                        <?php echo form_error('Senha', '<span class="alert-warning">', '</span>') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9 ">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" />
                                                Lembrar
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group last">
                                    <div class="col-sm-offset-5 col-sm-10">
                                        <button type="submit" class="btn btn-success btn-sm">
                                            Entrar
                                        </button>
                                        <button type="reset" class="btn btn-default btn-sm">
                                            Reset
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>                  
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script src="<?php echo base_url('public2/login/jquery.dynamic.js') ?>"></script>
