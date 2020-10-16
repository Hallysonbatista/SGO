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
                        <div class="panel-heading">Cadastro de WO</div>
                        <div class="panel-body">
                        <div class="form-group">
                            <label for="inpuMatricula">Endereço ID:</label>
                            <input type="text" id="endid" disabled name="endid" class="form-control" value="">
                            <span class="help-block invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label for="inpuMatricula">Alvo:</label>
                            <input type="text" id="alvo"align = "center"  disabled name="alvo" class="form-control" value="">
                            <span class="help-block invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label for="inpuMatricula">Classificação HQ:</label>
                            <input type="text" id="classhq" disabled name="classhq" class="form-control" value="">
                            <span class="help-block invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label for="inpuMatricula">Data Execução:</label>
                            <input type="date" style="text-align: center;" id="dataexecucao" name="dataexecucao" class="form-control" value="">
                            <span class="help-block invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label>Status:</label>
                            <select id="statuscontratada" name="statuscontratada" class="form-control  select2" style="width: 100%">
                                <option value="Executada">Executada</option>
                                <option value="Analise">Analise</option>
                                <option value="Rejeitada">Rejeitada</option>
                                <option value="Desativado">Desativado</option>
                                <option value="Restrição de acesso">Restrição de acesso</option>
                                <option value="Chuva">Chuva</option>
                                <option value="Outros">Outros</option>
                            </select>
                            <span class="help-block invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label for="inputStatus">Técnico:</label>
                            <select id="usuario_idusuario" name="usuario_idusuario" class="form-control select2" style="width: 100%">
                                <?= $tecnico ?>
                            </select>
                            <span class="help-block invalid-feedback"></span>
                        </div>
                        <div class="form-group">
                            <label for="inputObservacoes">Obs:</label>
                            <textarea type="date" style="text-align: center;" id="observacoes" name="observacoes" class="form-control" value=""></textarea>
                            <span class="help-block invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-4 mx-auto">
                            <button type="submit" name="salvar" id="salvar"  class="btn btn-primary">
                                <i class="fa fa-save"></i>&nbsp;&nbsp;Salvar
                            </button>
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
                        <div class="panel-heading">Cadastrar WO</div>

                        <div class="panel-body">
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-2 control-label" for="Nome">Teste <h11>*</h11></label>  
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