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
            <?php $this->load->view("layout/topoTitulo"); ?>

            <?php // $this->load->view("layout/quadrados"); ?>
            <!-- .page-content -->


            <!-- / .row -->
            <!-- Minha pagina -->

            <form class="form-horizontal" method="post" name="form_add">
                <fieldset>
                    <div class="panel panel-primary">
                        <div class="panel-heading">Cadastro de Usuário</div>
                        <div class="panel-body">
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="Nome">Nome:</label>  
                                <div class="col-md-8">
                                    <input name="first_name" value = "<?php echo set_value('first_name'); ?>"  class="form-control input-md" type="text">
                                    <?php echo form_error('first_name', '<span asp-validation-for="first_name" class="text-danger">', '</span>') ?>
                                </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="CPF">CPF:</label>  
                                <div class="col-md-3">
                                    <input id="cpf" name="cpf" value="<?php echo set_value('cpf'); ?>" placeholder="Apenas números" class="form-control input-md cpf" type="text">
                                    <?php echo form_error('cpf', '<span asp-validation-for="cpf" class="text-danger">', '</span>') ?>
                                </div>
                                <label class="col-md-2 control-label" for="Matricula">Matricula Ezentis:</label>  
                                <div class="col-md-3">
                                    <input id="matricula" name="matricula" value="<?php echo set_value('matricula'); ?>" placeholder="Apenas números" class="form-control input-md" type="text">
                                    <?php echo form_error('matricula', '<span asp-validation-for="matricula" class="text-danger">', '</span>') ?>
                                </div>                                                              
                                <!-- Multiple Radios (inline) -->                                          
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="Matricula">Matricula Tim:</label>  
                                <div class="col-md-3">
                                    <input id="matriculaTim" name="matriculaTim" value="<?php echo set_value('matriculaTim'); ?>" class="form-control input-md" type="text">
                                    <?php echo form_error('matriculaTim', '<span asp-validation-for="matriculaTim" class="text-danger">', '</span>') ?>
                                </div>
                                <label class="col-md-2 control-label" for="Cm">Cm:</label>
                                <div class="col-md-4">
                                    <select name="cm" class="form-control">
                                        <option value=""></option>
                                        <?php foreach ($cms as $cm) : ?>
                                            <option value="<?php echo $cm->idcm ?>" ><?php echo $cm->nomecm ?></option>                                  
                                        <?php endforeach; ?>
                                    </select>
                                    <?php echo form_error('cm', '<span asp-validation-for="cm" class="text-danger">', '</span>') ?>
                                </div>
                            </div>

                            <!-- Prepended text-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="Telefone">Telefone</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                        <input id="prependedtext" value="<?php echo set_value('phone'); ?>" name="phone" class="form-control phone_with_ddd" placeholder="XX XXXXX-XXXX" type="text" maxlength="13" pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$"
                                               OnKeyPress="formatar('## #####-####', this)">                                                          
                                    </div>
                                    <?php echo form_error('phone', '<span asp-validation-for="phone" class="text-danger">', '</span>') ?>
                                </div>                        
                            </div> 

                            <!-- Prepended text-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="Email">Email</label>
                                <div class="col-md-5">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <input id="prependedtext" name="email" value="<?php echo set_value('email'); ?>" class="form-control" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" >                                                    
                                    </div>
                                    <?php echo form_error('email', '<span asp-validation-for="email" class="text-danger">', '</span>') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="Usuario ativo">Usuário ativo?</label>
                                <div class="col-md-3">
                                    <select name="active" class="form-control"> 
                                        <option value=""></option>
                                        <option value="1">SIM</option>
                                        <option value="0">NÃO</option>

                                    </select>
                                    <?php echo form_error('active', '<span asp-validation-for="active" class="text-danger">', '</span>') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="Perfil do usuario">Perfil do usuário</label>
                                <div class="col-md-3">
                                    <select name="perfil_usuario" class="form-control"> 
                                        <option value=""></option>
                                        <option value="5">Técnico</option>
                                        <option value="1">Administrador</option>
                                        <option value="2">Coordenador</option>
                                        <option value="3">BackOffice</option>
                                        <option value="4">Lider de Equipe</option>
                                    </select>
                                    <?php echo form_error('perfil_usuario', '<span asp-validation-for="perfil_usuario" class="text-danger">', '</span>') ?>
                                </div>
                            </div>
                            <div class="panel-body">
                                <!-- Text input-->
                                <div class="form-group">
                                    <!--<label class="col-md-2 control-label" for="Senha">Senha</label>-->  
                                    <div class="col-md-8">
                                        <label class="col-md-2 control-label" for="Cadastrar"></label>
                                        <button class="btn btn-success" type="Submit">Cadastrar</button>
                                        <a href="<?php base_url() ?>listarUsuarios" class="btn btn-danger" type="">Cancelar</a>
                                            <!--<input name="password" value = ""   class="form-control input-md" type="password">-->
                                        <?php echo form_error('password', '<span asp-validation-for="password" class="text-danger">', '</span>') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-body">
                                <!-- Text input-->
                                <div class="form-group">
                                    <!--<label class="col-md-2 control-label" for="Confirmar Senha">Confirmar senha</label>-->  
                                    <div class="col-md-3">
                                        <!--<input name="confirm_password" value = ""  class="form-control input-md" type="password">-->
                                        <?php echo form_error('confirm_password', '<span asp-validation-for="confirm_password" class="text-danger">', '</span>') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="Cadastrar"></label>
                                <div class="col-md-8">
                                    <!--                                                <button class="btn btn-success" type="Submit">Cadastrar</button>
                                                                                    <button href="<?php base_url('Usuario') ?>" class="btn btn-danger" type="">Cancelar</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </form>





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
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="form-horizontal" method="POST" name="form_edit">
                <fieldset>
                    <div class="panel panel-primary">
                        <div class="panel-heading">Cadastro de Cliente</div>

                        <div class="panel-body">
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="Nome">Nome <h11>*</h11></label>  
                                <div class="col-md-8">
                                    <input id="Nome" name="Nome" placeholder="" class="form-control input-md" required="" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="Nome">CPF <h11>*</h11></label>  
                                <div class="col-md-3">
                                    <input id="cpf" name="cpf" placeholder="Apenas números" class="form-control input-md" required="" type="text" maxlength="11" pattern="[0-9]+$">
                                </div>

                                <!--                                <label class="col-md-2 control-label" for="Nome">Nascimento<h11>*</h11></label> 
                                                                <div class="col-md-4">
                                                                    <input id="dtnasc" name="dtnasc" placeholder="DD/MM/AAAA" class="form-control input-md" required="" type="text" maxlength="10" OnKeyPress="formatar('##/##/####', this)" onBlur="showhide()">
                                                                </div>-->
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="prependedtext">Telefone <h11>*</h11></label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                        <input id="prependedtext" name="prependedtext" class="form-control" placeholder="XX XXXXX-XXXX" required="" type="text" maxlength="13" pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$"
                                               OnKeyPress="formatar('## #####-####', this)">
                                    </div>
                                </div>

                                <label class="col-md-1 control-label" for="prependedtext">Telefone</label>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                                        <input id="prependedtext" name="prependedtext" class="form-control" placeholder="XX XXXXX-XXXX" type="text" maxlength="13"  pattern="\[0-9]{2}\ [0-9]{4,6}-[0-9]{3,4}$"
                                               OnKeyPress="formatar('## #####-####', this)">
                                    </div>
                                </div>
                            </div>
                        </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
</body>
</html>