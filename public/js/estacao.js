$(function() {

	function permissao(){

		swal("Atenção!", "Voce não tem permissão para executar a ação!!", "warning");
	}

	function active_btn_estacao() {
		
		$(".btn-edit-estacao").click(function(){
			
			$.ajax({
				type: "POST",
				url: BASE_URL + "Estacao/editarEstacao",
				dataType: "json",
				data: {"idEstacao": $(this).attr("idEstacao")},

				success: function(response) {				
					$.each(response["input"], function(id, value) {
						clearErros();
						if(id=="cidade"){
							$("select[name="+id+"] option[value="+id+"]").attr("selected",true);
							$("select[name="+id+"]").val(value).change();
						}						
						if(id=="cm_idcm"){
							$("select[name="+id+"] option[value="+value+"]").attr("selected",true);
							$("select[name="+id+"]").val(value).change();
						}else{
							$("#"+id).val(value);
						}						
					});
					$("#editarEstacao").modal();
				}
			})			
		});
	}

	var listaUsuario = $("#listaEstacao").DataTable({
		"oLanguage": DATATABLE_PTBR,
		"autoWidth": false,
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": BASE_URL + "Estacao/ajaxListeEstacao",
			"type": "POST",
		},
		"columnDefs":[
		{targets: "no-sort", orderable: false},
		{targets: "dt-center", className: "dt-center"},
		],
		"drawCallback": function(){
			active_btn_estacao();
		}
	})

	$("#formListaEstacao").submit(function() {
		$.ajax({
			type: "POST",
			url: BASE_URL + "Estacao/saveEstacao",
			dataType: "json",
			data: $(this).serialize(),
			beforeSend: function() {
				clearErros();
				$("#btn_save_user").siblings(".help-block").html(loadingImg("Verificando..."));
			},
			success: function(response) {
				clearErros();
				if (response["status"] == 1) {
					permissao();					
				}
				if (response["status"]==0) {
					$("#modal_perfil").modal("hide");
					swal("Sucesso!","Estação alterado com sucesso!", "success");					
				} if(response["status"]==2) {
					showErrorsUser(response["error_list"])
				}
			}
		})

		return false;
	});





$("#FormCadastroEstacao").submit(function() {

		$.ajax({			
			type: "POST",
			url: BASE_URL + "Estacao/saveNovaEstacao",
			dataType: "json",
			data: $(this).serialize(),
			beforeSend: function() {
				clearErros();
				$("#salvar").parent().siblings(".help-block").html(loadingImg("Verificando..."));
			},
			success: function(response) {

				if (response["status"]) {		
					swal.fire({
						title: "Sucesso!",
						text: "Estação Cadastrada com sucesso",
						html: 'informações: <br/><br/>'+
						'<h2>' + response["endid"] + '</h2>',
						type: "success",
						confirmButtonText: "Ok",
						closeOnConfirm: true,
					}).then((result) => {
						if (result.value) {
							window.location.replace("listarUsuario");
						}
					})
				} else {
					showErrorsUser(response["error_list"]);
				}
			}
		})

		return false;
	});

})