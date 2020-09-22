<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Hallyson Batista - TSL - Ezentis 2018</span>
        </div>
    </div>

</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper fim MENU -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SAIR?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Selecione "Sair" abaixo se você estiver pronto para terminar sua sessão atual.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?= base_url() ?>restrict/logoff">Sair</a>
            </div>
        </div>
    </div>
</div>
<!--
MODAL
-->
<div id="modal_perfil" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header text-center">
            <h4 class="modal-title w-100 font-weight-bold">Meu Perfil</h4>
            <button type="button" class="close" data-dismiss="modal" onclick="habilitar()" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="form_perfil">
                <div class="form-group">
                    <i class="fas fa-user prefix grey-text"></i>
                    <label class="col-lg-4 control-label">Nome Completo</label>
                    <div class="col-lg-10">
                      <input id="modal_nomeusuario" name="modal_nomeusuario" class="form-control validate" maxlength="100">
                      <span class="help-block" style="color:red"></span>
                  </div>
              </div>
              <div class="form-group">
                <i class="fas fa-envelope prefix grey-text"></i>
                <label class="col-lg-2 control-label">E-mail 1</label>
                <div class="col-lg-10">
                    <input type="email" id="modal_email1" name="modal_email1" value="" class="form-control validate" maxlength="100">
                    <span class="help-block" style="color:red"></span>
                </div>
            </div>

            <div class="form-group">
                <i class="fas fa-envelope prefix grey-text"></i>
                <label class="col-lg-2 control-label">E-mail 2</label>
                <div class="col-lg-10">
                    <input type="email" id="modal_email2" name="modal_email2" value="" class="form-control validate" maxlength="100">
                    <span class="help-block" style="color:red"></span>
                </div>
            </div>
            <div class="form-group">
                <div align="center">
                    Click para alterar senha
                    <input type="checkbox" name="alterarSenha" id="alterarSenha" value="1" onchange="habilitar()" />      

                </div>
            </div>
            <div class="form-group" id="senha_1" hidden>
                <i class="fas fa-lock prefix grey-text"></i>
                <label class="col-lg-4 control-label">Senha</label>
                <div class="col-lg-10">
                    <input type="password" id="modal_senha" name="modal_senha" value="" class="form-control validate">
                    <span class="help-block" style="color:red"></span>
                </div>
            </div>
            <div class="form-group" id="senha_2" hidden>
                <i class="fas fa-lock prefix grey-text"></i>
                <label class="col-lg-4 control-label">Confirmar Senha</label>
                <div class="col-lg-10">
                    <input type="password" id="modal_senhaConfirm" name="modal_senhaConfirm" value="" class="form-control validate">
                    <span class="help-block" style="color:red"></span>
                </div>
            </div>

            <div class="form-group text-center">
                <button type="submit" id="btn_save_user" class="btn btn-primary">
                  <i class="fa fa-save"></i>&nbsp;&nbsp;Salvar
              </button>
              <span class="help-block" style="color:red"></span>
          </div>

      </form>
  </div>
</div>
</div>
</div>
<script>    
    function habilitar(){
        if(document.getElementById('alterarSenha').checked){
            document.getElementById('senha_1').removeAttribute("hidden");
            document.getElementById('senha_2').removeAttribute("hidden");
        }
        else {
            document.getElementById("modal_senha").value = '';
            document.getElementById("modal_senhaConfirm").value = '';
            document.getElementById('senha_1').setAttribute("hidden", "hidden");
            document.getElementById('senha_2').setAttribute("hidden", "hidden");
        }

    }
</script>
<script>
    function sair(){
        $("#alterarSenha").prop("checked", false);
    }
</script>