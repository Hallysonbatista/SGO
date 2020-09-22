<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$nivelAcesso = $this->session->userdata("nAcesso");
//https://material.io/tools/icons/?icon=find_in_page&style=baseline  - icones
//<?php
// echo  "http://$_SERVER[HTTP_HOST]/ezentis";
?>

<br> 
<div class="tab-content">
    <div id="tab_courses" class="tab-pane active">
        <div class="container-fluid">
            <table id="listaEstacao"  class="table table-striped table-bordered">
                <thead>
                    <tr class="tableheader">
                        <th class="dt-center no-sort">End ID</th>
                        <th class="dt-center no-sort">Sigla</th>
                        <th class="dt-center no-sort">UF</th>
                        <th class="dt-center no-sort">Cidade</th>
                        <th class="dt-center no-sort">Sub CM</th>
                        <th class="dt-center no-sort">Ações</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<div id="editarEstacao" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Editar Estação</h4>
                <button type="button" class="close" data-dismiss="modal" onclick="habilitar()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formListaEstacao">
                    <div class="form-row">  
                        <div class="form-group col-md-4">
                            <label for="inpuEndId">END ID:</label>
                            <input type="endid1" id="endid1" disabled name="endid1" class="form-control" value="">
                            <span class="help-block invalid-feedback"></span>
                        </div>
                        <div>
                            <input type="endid" id="endid" hidden name="endid" class="form-control" value="">
                            <span class="help-block invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-2">
                            <i class="fas fa-user prefix grey-text"></i>
                            <label class="col-lg-100 control-label">UF</label>
                            <div class="col-lg-100">
                                <input type="uf" id="uf" name="uf" class="form-control validate" maxlength="100">
                                <span class="help-block" style="color:red"></span>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Sub Cm:</label>
                            <select name="cm_idcm" class="form-control select2"  id="cm_idcm" style="width: 100%">
                                <?= $cm ?>
                            </select>
                            <span class="help-block invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="inputEmail">Detentora</label>
                            <input type="detentoraarea" name="detentoraarea" class="form-control validate" id="detentoraarea">
                            <span class="help-block invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="inputEmail">Codigo de Energia</label>
                            <input type="codigoenergia" name="codigoenergia" value="" class="form-control validate" id="codigoenergia">
                            <span class="help-block invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail">Distância em KM</label>
                            <input type="km" name="km" id="km" onblur="checkDistancia(this.value);" value="" class="form-control validate" >
                            <span class="help-block invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputEmail">Horas</label>
                            <input type="time" name="hora" value="" class="form-control validate" id="hora">
                            <span class="help-block invalid-feedback"></span>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Cidade:</label>
                            <select name="cidade" class="form-control select2"  id="cidade" style="width: 100%">
                                <?= $cidade ?>
                            </select>
                            <span class="help-block invalid-feedback"></span>
                        </div>
                    </div>
                    <div class="form-group col-md-3 mx-auto">
                        <button type="submit" name="salvar" id="salvar" value="salvar" class="btn btn-primary">Salvar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function checkDistancia(valor) {
        if (document.getElementById("km").value === '') {
        } else {
            var regra = /^[0-9]+$/;
            if (valor.match(regra)) {

            } else {
                alert("KM invalida, deve conter apenas números!");
                var elemento = document.getElementById("km").value = '';
                callback();
            }
        }
    }
    ;
</script>
