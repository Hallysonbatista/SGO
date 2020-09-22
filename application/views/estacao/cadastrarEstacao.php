<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$nivelAcesso = $this->session->userdata("nAcesso");
?>


<form method="POST" name="FormCadastroEstacao" id="FormCadastroEstacao" style="width: 900px; margin: 0 auto;">
    <div class="form-row">  
        <div class="form-group col-md-3">
            <label for="inpuEndId">END ID:</label>
            <input type="endid" id="endid" name="endid" class="form-control" value="">
            <span class="help-block invalid-feedback"></span>
        </div>
        <div class="form-group col-md-4">
            <label for="inpuEndId">Sigla:</label>
            <input type="nomeestacao" id="nomeestacao" name="nomeestacao" class="form-control" value="">
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
    <br></br> 
    <div class="form-group col-md-3 mx-auto">
        <button type="submit" name="salvar" id="salvar" value="salvar" class="btn btn-primary">Salvar</button>
    </div>
</form>
</div>