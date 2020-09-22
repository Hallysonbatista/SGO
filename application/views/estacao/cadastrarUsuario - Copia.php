<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<form method="POST" name="FormCadastro" id="FormCadastro" style="width: 1000px; margin: 0 auto;">
    <div class="form-row">  
        <div class="form-group col-md-2">
            <label for="inpuMatricula">Matricula:</label>
            <input type="text" id="matricula" name="matricula" onblur="checkMatricula(this.value);" class="form-control" value="">
            <span class="help-block invalid-feedback"></span>
        </div>
        <div class="form-group col-md-9">
            <label for="inputNome">Nome:</label>
            <input type="text" name="nomeusuario" onblur="check(this.value);" id="nomeusuario" value="" class="form-control" >
            <span class="help-block invalid-feedback"></span>
        </div>

        <div class="form-group col-md-3">
            <label for="inputTelefone">Telefone 1:</label>
            <input type="text" name="telefone1" value="" class="form-control" id="telefone1">
            <span class="help-block invalid-feedback"></span>
        </div>

        <div class="form-group col-md-3">
            <label for="inputTelefone">Telefone 2:</label>
            <input type="text" name="telefone2" value="" class="form-control" id="telefone2">
            <span class="help-block invalid-feedback"></span>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-5">
            <label for="inputEmail">Email 1:</label>
            <input type="email" name="email1" value="" class="form-control validate" id="email1">
            <span class="help-block invalid-feedback"></span>
        </div>
        <div class="form-group col-md-5">
            <label for="inputEmail">Email 2:</label>
            <input type="email" name="email2" value="" class="form-control validate" id="email2">
            <span class="help-block invalid-feedback"></span>
        </div>
        <div class="form-group col-md-3">
            <label for="inputCPF">CPF:</label>
            <input type="text" id="cpf" name="cpf"  value="" onblur="checkCpf(this.value);" class="form-control">
            <span class="help-block invalid-feedback"></span>
        </div>
        <div class="form-group col-md-8">
            <label for="inputEndereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" value="" class="form-control">
            <span class="help-block invalid-feedback"></span>
        </div>
        <div class="form-group col-md-4">
            <label for="inputComplemento">Complemento:</label>
            <input type="text" name="complemento" value="" class="form-control" id="complemento">
            <span class="help-block invalid-feedback"></span>
        </div>
        <div class="form-group col-md-5">
            <label for="inputBairro">Bairro:</label>
            <input type="text" name="bairro" value="" class="form-control" id="bairro">
            <span class="help-block invalid-feedback"></span>
        </div>

        <div class="form-group col-md-4">
            <label>Cidade:</label>
            <select name="cidade" id="cidade" class="form-control select2">
                <option value=""><?= $cidade?></option>
            </select>
            <span class="help-block invalid-feedback"></span>
        </div>

        <div class="form-group col-md-4">
            <label>Cm:</label>
            <select name="cm_idcm" class="form-control select2"  id="cm_idcm">
                <?= $cm ?>
            </select>
            <span class="help-block invalid-feedback"></span>
        </div>
        <div class="form-group col-md-3">
            <label>Acesso:</label>
            <select name="nivelacesso_idnivelacesso" class="form-control" id="nivelacesso_idnivelacesso">
                <option value="1"></option>
            </select>
            <span class="help-block invalid-feedback"></span>
        </div>
    </div>
    <br></br>
    <div class="form-group col-md-3 mx-auto">
        <button type="submit" name="salvar" id="salvar" value="salvar" class="btn btn-primary">Salvar</button>
    </div>
</form>
<br></br>

<script type="text/javascript">
    function checkCpf(valor) {
        if (document.getElementById("cpf").value === '') {
        } else {
            var regra = /^[0-9]+$/;
            if (valor.match(regra)) {

            } else {
                alert("CPF Invalido, deve conter apenas números!");
                var elemento = document.getElementById("cpf").value = '';
            }
        }
    }
    ;
</script>
<script type="text/javascript">
    function checkMatricula(valor) {
        if (document.getElementById("matricula").value === '') {
        } else {
            var regra = /^[0-9]+$/;
            if (valor.match(regra)) {

            } else {
                alert("Matricula invalida, deve conter apenas números!");
                var elemento = document.getElementById("matricula").value = '';
                callback();
            }
        }
    };
</script>
