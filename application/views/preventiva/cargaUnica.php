<?php
?>
<script type="text/javascript">
    $(function(){
        var base_url = "<?php echo base_url() ?>";
        $('#estacao').change(function(){
            $('#estacao_idestacao').attr('disabled', 'disabled');
            $('#estacao_idestacao').html("<option>Carregando...</option>");
            endId = $('#estacao').val();
            $.post(base_url+'ajax/preventiva/cargaPreventivaEstacao',{
                endId : endId
            },function(data){
                $('#estacao_idestacao').html(data);
                $('#estacao_idestacao').removeAttr('disabled');
            });
        });
    });

</script>
<div class="container">
    <form method="POST" name="FormCargaUnica" id="FormCargaUnica">
        <div class="form-row">
            <div class="form-group col-md-6">
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="inpuSgmp">ID SGMP</label>
                        <input type="sgmp"  name="sgmp"  class="form-control" id="sgmp" onblur="checkNumber(this.value);">
                        <span class="help-block invalid-feedback"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputNome">Endereço Id</label>
                        <select type="Endereco" name="estacao"  class="form-control select2" id="estacao">
                            <?= $endId ?>
                        </select>
                        <span class="help-block invalid-feedback"></span>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputNome">Sigla</label>
                        <select type="estacao_idestacao" name="estacao_idestacao"  disabled class="form-control select2" id="estacao_idestacao">
                            <?= $endId ?>
                        </select>
                        <span class="help-block invalid-feedback"></span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputTelefone">Alvo</label>
                        <select type="alvo" name="alvo" class="form-control select2" id="alvo">
                            <option label="AGREGADOR - TELLABS" value="">Selecione o Alvo
                            </option>
                            <option label="AGREGADOR - TELLABS" value="AGREGADOR - TELLABS">AGREGADOR - TELLABS
                            </option>
                            <option label="AR CONDICIONADO SELF" value="AR CONDICIONADO SELF">AR CONDICIONADO SELF</option>
                            <option label="ATERRAMENTO - PI" value="ATERRAMENTO - PI">ATERRAMENTO - PI</option>
                            <option label="ATERRAMENTO ANUAL" value="ATERRAMENTO ANUAL">ATERRAMENTO ANUAL</option>
                            <option label="BANCO DE BATERIAS - PI" value="BANCO DE BATERIAS - PI">BANCO DE BATERIAS - PI</option>
                            <option label="BANCO DE BATERIAS NO BREAK" value="BANCO DE BATERIAS NO BREAK">BANCO DE BATERIAS NO BREAK</option>
                            <option label="BOMBAS CENTRIFUGAS" value="BOMBAS CENTRIFUGAS">BOMBAS CENTRIFUGAS</option>
                            <option label="CHILLER" value="15">CHILLER</option>
                            <option label="CORE ACCESS - BSC/RNC" value="CORE ACCESS - BSC/RNC">CORE ACCESS - BSC/RNC</option>
                            <option label="DWDM Logical Preventive Maintenance" value="DWDM Logical Preventive Maintenance">DWDM Logical Preventive Maintenance</option>
                            <option label="EQUIPAMENTO DE ACESSO" value="EQUIPAMENTO DE ACESSO">EQUIPAMENTO DE ACESSO</option>
                            <option label="EQUIPAMENTO DE MW" value="EQUIPAMENTO DE MW">EQUIPAMENTO DE MW</option>
                            <option label="EQUIPAMENTO REDE ÓPTICA" value="EQUIPAMENTO REDE ÓPTICA">EQUIPAMENTO REDE ÓPTICA</option>
                            <option label="ESTRUTURA VERTICAL" value="ESTRUTURA VERTICAL">ESTRUTURA VERTICAL</option>
                            <option label="FAN COIL" value="FAN COIL">FAN COIL</option>
                            <option label="FCC - PI" value="FCC - PI">FCC - PI</option>
                            <option label="GMG - PI" value="GMG - PI">GMG - PI</option>
                            <option label="INFRAESTRUTURA GERAL" value="INFRAESTRUTURA GERAL">INFRAESTRUTURA GERAL</option>
                            <option label="INFRAESTRUTURA GERAL - MSAN" value="INFRAESTRUTURA GERAL - MSAN">INFRAESTRUTURA GERAL - MSAN</option>
                            <option label="INFRAESTRUTURA GERAL - SATÉLITE" value="INFRAESTRUTURA GERAL - SATÉLITE">INFRAESTRUTURA GERAL - SATÉLITE</option>
                            <option label="INSTALAÇÕES CIVIS" value="INSTALAÇÕES CIVI">INSTALAÇÕES CIVIS</option>
                            <option label="INSTALAÇÕES ELÉTRICAS - PI" value="INSTALAÇÕES ELÉTRICAS - PI">INSTALAÇÕES ELÉTRICAS - PI</option>
                            <option label="MEDIÇÕES CONDUTÂNCIA/IMPEDÂNCIA" value="MEDIÇÕES CONDUTÂNCIA/IMPEDÂNCIA">MEDIÇÕES CONDUTÂNCIA/IMPEDÂNCIA</option><option label="NO BREAK" value="NO BREAK">NO BREAK</option>
                            <option label="QUADROS ELÉTRICOS" value="QUADROS ELÉTRICOS">QUADROS ELÉTRICOS</option>
                            <option label="SUBESTAÇÃO - PI" value="SUBESTAÇÃO - PI">SUBESTAÇÃO - PI</option>
                            <option label="TORRE DE ARREFECIMENTO - PI" value="TORRE DE ARREFECIMENTO - PI">TORRE DE ARREFECIMENTO - PI</option>
                            <option label="VENTILADOR/EXAUSTOR - PI" value="VENTILADOR/EXAUSTOR - PI">VENTILADOR/EXAUSTOR - PI</option>
                            <option label="ZELADORIA" value="ZELADORIA">ZELADORIA</option>
                            <option label="ZELADORIA - PI" value="ZELADORIA - PI">ZELADORIA - PI</option></select>
                        </select>
                        <span class="help-block invalid-feedback"></span>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="inputTelefone">ORIGEM</label>
                        <select type="origemdemanda" name="origemdemanda" class="form-control select2" id="origemdemanda">
                            <option value="">Selecione a Origem</option>
                            <option value="Cronograma">Cronograma</option>
                            <option value="Aceitação Física">Aceitação Física</option>
                        </select>
                        <span class="help-block invalid-feedback"></span>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="inputTelefone">Contrato</label>
                        <select type="contrato" name="contrato" class="form-control select2" id="contrato">
                            <option value="">Selecione o contrato</option>
                            <option value="FMMT_Franquia">FMMT_Franquia</option>
                            <option value="FMMT_Estrutura Vertical">FMMT_Estrutura Verticala</option>
                            <option value="FMMT_Franquia_LD">FMMT_Franquia_LD</option>
                            <option value="FMMT_Prédio">FMMT_Prédio</option>
                            <option value="FMMT_Zeladoria">FMMT_Zeladoria</option>
                        </select>
                        <span class="help-block invalid-feedback"></span>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputEmail">Mês da programação</label>
                        <input type="date" name="mesprogramacao" class="form-control" id="mesprogramacao">
                        <span class="help-block invalid-feedback"></span>
                    </div>
                    <br></br><br></br>
                </div>
                <div class="row d-flex justify-content-center">
                    <button type="submit" name="salvar" id="salvar"  class="btn btn-primary">
                        <i class="fa fa-save"></i>&nbsp;&nbsp;Cadastrar
                    </button>  
                </div>
            </div>
        </div>
    </form>

    <script type="text/javascript">
        function checkNumber(valor) {
            var regra = /^[0-9]+$/;
            if (valor.match(regra)) {

            } else {
                alert("ID SGMP invalido!");
                var elemento = document.getElementById("sgmp").value = '';
            }
        }
        ;
    </script>


</div>
</div>