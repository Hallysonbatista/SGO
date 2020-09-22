<div class="container ">
    <form action="atualizarPreventivaSalvar?id=<?= $id; ?>"  method="POST" name="formulario" > 
        <div class="col-md-6 offset-md-3">
            <div class="form-group" align = "center">               
                <label>Endereço ID:</label>
                <input tInfraestrutura Geralype = "text" style = "text-align: center;" class = "form-control" disabled name = "enderecoId" value = "<?= $preventiva->endid; ?>" ><br>
                <label>Alvo:</label>
                <input type = "text" style = "text-align: center;" class = "form-control" disabled name = "alvo" value = "<?= $preventiva->alvo; ?>"><br>
                <label>Class ClassificacaoHq:</label>
                <input type = "text" style = "text-align: center;" class = "form-control" disabled name = "classificacaoHq" value = "<?= $preventiva->classhq; ?>"><br>
                <label>Data Execução:</label>
                <input type = "date" id = "date" style="text-align: center;" class = "form-control" name = "dataExec" value = "<?= $preventiva->dataexecucao; ?>"><br>
                <label>StatusEzentis</label>  
                <select class="form-control select2" name="statuscontratada">
                    <option value="<?= $preventiva->statuscontratada; ?>"><?= $preventiva->statuscontratada; ?></option>
                    <option value="Executada">Executada</option>
                    <option value="Analise">Analise</option>
                    <option value="Rejeitada">Rejeitada</option>
                    <option value="Desativado">Desativado</option>
                    <option value="Restrição de acesso">Restrição de acesso</option>
                    <option value="Chuva">Chuva</option>
                    <option value="Outros">Outros</option>
                </select><br></br>
                <label>Técnico:</label>
                <select class="form-control select2" name="tecnico">
                    <?php if ($preventiva->nomeusuario == 'Agendamento') { ?>
                        <option value="1">Selcione o técnico</option>
                    <?php } else { ?>
                        <option value="<?= $preventiva->idusuario ?>"><?= $preventiva->nomeusuario ?></option>
                        <?php
                    }
                    echo $tecnico
                    ?>
                </select><br></br>
                <label>Obs:</label>
                <textarea class="form-control" name="observacoes" style="text-align: center;"><?= $preventiva->observacoes; ?></textarea></br>
              <!--
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="">										
                    Cadastrar pêndencia
                </button><br></br>
              -->
                <input type="submit" value="Atualizar" name="teste" class="btn btn-primary"><br></br>
                <a href="list-preventiva"><button type="button" class="btn btn-primary">Cancelar</button></a></br>
            </div>
            <div class="form-group">
            </div>
        </div>
    </form> 
</div>
</div>

<!-- MODAL  -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <style type="text/css">
                .carregando{
                    color:#ff0000;
                    display:none;
                }
            </style>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5> 
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" id="id" name="idEstacoes" > 
                        <input type="hidden" id="idP" name="idPreventiva">
                        <input type="hidden" id="endid" name="endid">
                        <input type="hidden" id="idprev" name="idprev">
                        <input type="hidden" name="salvar" value="1">
                        <label>Selecione a Pendência:</label>
                        <select name="id_categoria" id="id_categoria" required class="form-control">
                            <option value="">Escolha a Pendência</option>
                        </select><br>
                        <label>Subcategoria:</label>
                        <span class="carregando">Aguarde, carregando...</span>
                        <select name="id_sub_categoria" id="id_sub_categoria" required class="form-control">
                            <option value="">Escolha a Subcategoria</option>
                        </select>
                        <br>
                        <label>Origem da Pendência:</label>
                        <select  class="form-control" name="origemPendencia">
                            <option value="valor1"></option>
                            <option value="Preventiva">Preventiva</option>
                            <option value="W.O">W.O.</option>
                            <option value="Corretiva">Corretiva</option>
                        </select>
                        <br>
                        <label>Encaminhado para:</label>
                        <select  class="form-control" name="encaminhaPara">
                            <option value=""></option>
                            <option value="Reparo">Reparo</option>
                            <option value="Melhoria">Melhoria</option>
                        </select>
                        <br>
                        <label>Compete a:</label>
                        <select  class="form-control" name="compete">
                            <option value=""></option>
                            <option value="Ezentis">Ezentis</option>
                            <option value="TIM">TIM</option>
                            <option value="Detentora">Detentora</option>
                        </select>
                        <br>
                        <label>Técnico:</label>
                        <select style="text-align: center;" class="form-control" name="Nome" class ="form-control selectpicker" DataExec-live-search="true">

                        </select>		
                        <br>
                        Data Registro:<input type="date"  class="form-control" required name="dataRegistro" value=""><br>
                        Informações:
                        <br>
                        <textarea name="observacoes"  class="form-control" value="" ></textarea><br>
                        Arquivo: <input type="file" name="arquivo" class="btn btn-default"><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default">Fechar</button>
                        <button type="submit" class="btn btn-primary" data-dismiss="modal">Salvar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- FIM MODAL  -->
</div>