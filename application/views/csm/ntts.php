<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<br>
<!-- <p id="data_hora"></p> -->
<div id="formNtt" class="tab-content">
	<div id="tab_courses" class="tab-pane active">
		<div class="container-fluid">
			<table id="listaNtt" data-page-length='1000' class="table table-striped table-bordered">
				<thead>
					<tr class="tableheader">
						<th class="dt-center">NTT</th>
						<th class="dt-center no-sort">Site</th>
						<th class="dt-center no-sort">PI</th>
						<th class="dt-center no-sort">Prioridade</th>				
						<th class="dt-center no-sort">Falha</th>						
						<th class="dt-center no-sort">GMG</th>						
						<th class="dt-center no-sort">Atualização</th>						
						<th class="dt-center no-sort">Ações</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>


<div id="editarNtt" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header text-center">
				<h4 class="modal-title w-100 font-weight-bold">Atualizar NTT</h4>
				<button type="button" class="close" data-dismiss="modal" onclick="habilitar()" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="formListaNtt" enctype="multipart/form-data">
					<div class="col-md-6 offset-md-3">
						<div class="form-group" align = "center"> 
							<input type="text" id="idNtt"  name="idNtt" hidden class="form-control" value="">
							<input type="text" id="bo"  name="bo" hidden class="form-control" value="">

							<div class="form-group">
								<label for="inputTec">Técnico:</label>
								<select id="usuario_idusuario" name="usuario_idusuario" class="form-control select2" style="width: 100%">
									<?= $tecnico ?>
								</select>
								<span class="help-block invalid-feedback"></span>
							</div>                                                
							<div class="form-group">
								<label for="inputVand">Vandalizado:</label>
								<select id="vandalismo" name="vandalismo" class="form-control  select2" style="width: 100%">
									<option value="NÃO">Não</option>
									<option value="Sim">Sim</option>
								</select>
								<span class="help-block invalid-feedback"></span>
							</div>
							<div class="form-group">
								<label for="inpuMatricula">Previsão:</label>
								<input type="datetime-local" style="text-align: center;" id="previsao" name="previsao" class="form-control" value="">
								<span class="help-block invalid-feedback"></span>
							</div>
							<div class="form-group">
								<label for="inputObservacoes">Atualização:</label>
								<textarea type="date" style="text-align: center;" id="atualizacao" maxlength="500" name="atualizacao" class="form-control" value=""></textarea>
								<span class="help-block invalid-feedback"></span>
							</div>
							<div class="form-group">
								<label for="inputObservacoes">Ultima Nota:</label>
								<textarea type="date"  maxlength="500" style="text-align: center;" id="ultimaNota" name="ultimaNota" class="form-control" value=""></textarea>
								<span class="help-block invalid-feedback"></span>
							</div>
							<div class="form-group col-md-4 mx-auto">
								<button type="submit" name="salvar" id="salvar"  class="btn btn-primary">
									<i class="fa fa-save"></i>&nbsp;&nbsp;Salvar
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('#editarNtt').on('hide.bs.modal', function (event) {
  //executar algo...
  alert('modal fechou');
})
</script>