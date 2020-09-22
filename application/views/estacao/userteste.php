<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<form  name="FormCadastro" id="FormCadastro" style="width: 1000px; margin: 0 auto;">
    <div class="form-row">  
        <div class="form-group col-md-2">
            <label for="inpuMatricula">Mat:</label>
            <div class="col-lg-10">
                <input type="text" id="matricula" name="matricula" class="form-control" value="">
            </div>
            <span class="help-block"></span>
        </div>
    <div class="form-group col-md-9">
        <label for="inputNome">Nome:</label>
        <div class="col-lg-10">
            <input type="text" name="nomeusuario" value="" class="form-control" id="inputNome">
        </div>
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-3">
        <label for="inputTelefone">Telefone 1:</label>
        <div class="col-lg-10">
            <input type="text" name="telefone1" value="" class="form-control" id="inputTelefone">
        </div>
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-3">
        <label for="inputTelefone">Telefone 2:</label>
        <div class="col-lg-10">
            <input type="text" name="telefone2" value="" class="form-control" id="inputTelefone">
        </div>
        <span class="help-block"></span>
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-5">
        <label for="inputEmail">Email 1:</label>
        <div class="col-lg-10">
            <input type="text" name="email1" value="" class="form-control" id="inputEmail">
        </div>
        <span class="help-block"></span>
    </div>
    <div class="form-group col-md-5">
        <label for="inputEmail">Email 2:</label>
        <div class="col-lg-10">
            <input type="text" name="email2" value="" class="form-control" id="inputEmail">
        </div>
        <span class="help-block"></span>
    </div>
    <div class="form-group col-md-3">
        <label for="inputCPF">CPF:</label>
        <div class="col-lg-10">
            <input type="text" id="cpf"name="cpf" value="" class="form-control" id="inputcpf">
        </div>
        <span class="help-block"></span>
    </div>
    <div class="form-group col-md-8">
        <label for="inputEndereco">Endereço:</label>
        <div class="col-lg-10">
            <input type="text" id="endereco" name="endereco" value="" class="form-control">
        </div>
        <span class="help-block"></span>
    </div>
    <div class="form-group col-md-4">
        <label for="inputComplemento">Complemento:</label>
        <div class="col-lg-10">
            <input type="text" name="complemento" value="" class="form-control" id="inputComplemento">
        </div>
        <span class="help-block"></span>
    </div>
    <div class="form-group col-md-5">
        <label for="inputBairro">Bairro:</label>
        <div class="col-lg-10">
            <input type="text" name="bairro" value="" class="form-control" id="inputBairro">
        </div>
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-4">
        <label>Cidade:</label>
        <div class="col-lg-10">
            <select name="cidade" id="cidade"  class="form-control select2">
                <option value=""><?= $cidade?></option>
            </select>
        </div>
        <span class="help-block"></span>
    </div>

    <div class="form-group col-md-4">
        <label>Cm:</label>
        <div class="col-lg-10">
            <select name="cm_idcm" class="form-control"   id="Cm">
                <?= $cm ?>
            </select>
        </div>
        <span class="help-block"></span>
    </div>
    <div class="form-group col-md-3">
        <label>Acesso:</label>
        <div class="col-lg-10">
            <select name="nivelacesso_idnivelacesso"   class="form-control" id="Acesso">
                <option value="1"></option>
            </select>
        </div>
        <span class="help-block"></span>
    </div>
</div>
<br></br>
<div class="form-group col-md-3 mx-auto">
    <button type="submit" name="salvar" id="salvar" value="salvar" id="salvar" class="btn btn-primary">Salvar</button>
</div>
</form>
<br></br>