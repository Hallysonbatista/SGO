
<form method="POST" name="FormCadastro" id="FormCadastro" action="" style="width: 1000px; margin: 0 auto;">
    <div class="form-row">  
        <div class="form-group col-md-2">
            <label for="inpuMatricula">Matricula</label>
            <input type="text" required="" name="matricula" class="form-control" id="matricula" value="<?= $usuario->matricula?>" placeholder="Matricula">
        </div>
        <div class="form-group col-md-9">
            <label for="inputNome">Nome</label>
            <input type="text" name="nomeusuario" value="<?= $usuario->nomeusuario; ?>" required="" class="form-control" id="inputNome" placeholder="Nome">
        </div>

        <div class="form-group col-md-3">
            <label for="inputTelefone">Telefone 1</label>
            <input type="text" name="telefone1" value="<?= $usuario->telefone1; ?>" class="form-control" id="inputTelefone" placeholder="Telefone">
        </div>
        <div class="form-group col-md-3">
            <label for="inputTelefone">Telefone 2</label>
            <input type="text" name="telefone2" value="<?= $usuario->telefone2; ?>" class="form-control" id="inputTelefone" placeholder="Telefone">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-5">
            <label for="inputEmail">Email 1</label>
            <input type="text" name="email1" value="<?= $usuario->email1; ?>" class="form-control" id="inputEmail" placeholder="Email">
        </div>
        <div class="form-group col-md-5">
            <label for="inputEmail">Email 2</label>
            <input type="text" name="email2" value="<?= $usuario->email2; ?>" class="form-control" id="inputEmail" placeholder="Email">
        </div>
        <div class="form-group col-md-3">
            <label for="inputCPF">CPF</label>
            <input type="text" name="cpf" required="" value="<?= $usuario->cpf; ?>" class="form-control" id="inputcpf">
        </div>
        <div class="form-group col-md-8">
            <label for="inputEndereco">Endereço</label>
            <input type="text" id="endereco" name="endereco" value="<?= $usuario->endereco; ?>" class="form-control">
        </div>
        <div class="form-group col-md-4">
            <label for="inputComplemento">Complemento</label>
            <input type="text" name="complemento" value="<?= $usuario->complemento; ?>" class="form-control" id="inputComplemento">
        </div>
        <div class="form-group col-md-5">
            <label for="inputBairro">Bairro</label>
            <input type="text" name="bairro" value="<?= $usuario->bairro; ?>" class="form-control" id="inputBairro">
        </div>
        <div class="form-group col-md-5">
            <label>Estado:</label>
            <select name="cbx_estado"  id="cbx_estado" class="form-control">
                <option value=""></option>

            </select>
        </div>
        <div class="form-group col-md-4">
            <label>Cidade:</label>

            <select name="cidade" id="cidade" class="form-control">
                <option value=""></option>
            </select>
        </div>

        <div class="form-group col-md-4">
            <label>Cm:</label>
            <select name="cm_idcm" class="form-control"  id="Cm">
             <option value="<?= $usuario->cm_idcm?>"><?= $usuario->nomecm?></option>
                <?= $cm ?>
            </select>
        </div>
        <div class="form-group col-md-3">

            <label>Acesso:</label>
            <select name="nivelacesso_idnivelacesso"   class="form-control" id="Acesso">
                <option value="<?= $usuario->nivelacesso_idnivelacesso?>"><?=$usuario->nivelacesso ?></option>
                <?= $nivelacesso ?>

            </select>
        </div>
    </div>

<div class="form-group col-md-3 mx-auto">
    <button type="submit" name="salvar" value="salvar" id="salvar" class="btn btn-primary" onclick="return confirm('Tem certeza que deseja inserir este registro?')">Salvar</button>
</div>

</form>
<div class="form-group col-md-3 mx-auto">
    <button type="submit" name="submit" id ="editar" class="btn btn-primary" onclick="habilitaEdcao()">&nbsp;&nbsp;Editar&nbsp;&nbsp;&nbsp;</button><br>
</div>
<div class="form-group col-md-3 mx-auto">
    <button type="submit" name="cancelar" class="btn btn-primary" onclick="cancelar()">Cancelar</button><br>
</div>


</div>
<script>
    var inputs = document.getElementsByTagName("input");
    var select = document.getElementsByTagName("select");
    document.getElementById('salvar').style.visibility = 'hidden';
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].disabled = true;
    }
    for (var i = 0; i < select.length; i++) {
        select[i].disabled = true;
    }
</script>
<script>
    function habilitaEdcao() {
        var inputs = document.getElementsByTagName("input");
        var select = document.getElementsByTagName("select");
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].disabled = false;
        }
        for (var i = 0; i < select.length; i++) {
            select[i].disabled = false;
        }
        document.getElementById('editar').style.visibility = 'hidden';
        document.getElementById('salvar').style.visibility = 'visible';
    }

</script>
<script>
    function cancelar() {
        location.href = "listarUsuario";
    }
</script>
