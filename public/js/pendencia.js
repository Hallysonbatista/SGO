$(function() {

	function permissao(){

		swal("Atenção!", "Voce não tem permissão para executar a ação!!", "warning");
	}

	var validarPendencia = $("#validarPendencia").DataTable({
		"oLanguage": DATATABLE_PTBR,
		"autoWidth": false,
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": BASE_URL + "Pendencia/ajaxValidarPendencia",
			"type": "POST",
		},
		"columnDefs":[
		{targets: "no-sort", orderable: false},
		{targets: "dt-center", className: "dt-center"},
		],
		"drawCallback": function(){
			active_btn_pendencia();
		}
	})

	function active_btn_pendencia() {
		
		$(".btn-edit-pendencia").click(function(){
			$.ajax({
				type: "POST",
				url: BASE_URL + "Pendencia/editarValidarPendencia",
				dataType: "json",
				data: {"idpendencia": $(this).attr("idpendencia")},

				success: function(response) {		
					clearErros();
					$("#formListaValidaPendencia")[0].reset();
					$.each(response["input"], function(id, value) {

						$("#"+id).val(value);

					});
					clearErros();
					$("#modal_validarPendencia").modal();

				}
			})	
		});
		$(".btn-del-pendencia").click(function(){
			
			idpendencia = $(this).attr("idpendencia")
			swal({
				title: "Atenção!",
				text: "Deseja deletar esta pendência?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#d9534f",
				confirmButtonText: "Sim",
				cancelButtontext: "Não",
				closeOnConfirm: true,
				closeOnCancel: true,
			}).then((result) => {
				if (result.value) {
					$.ajax({
						type: "POST",
						url: BASE_URL + "Pendencia/deletarPendencia",
						dataType: "json",
						data: {"idpendencia": idpendencia},
						success: function(response) {
							if (response["status"] == 1) {
								swal({
									title: "Sucesso!",
									text: "Pendência deletada com sucesso",
									type: "success",
									confirmButtonText: "Ok",
									closeOnConfirm: true,
								}).then((result) => {
									if (result.value) {
										setTimeout(function(){location.reload(); }, 0);
									}
								})
							}else{
								permissao();
							}
						}
					})
				}
			})

		});
	}

	$("#formListaValidaPendencia").submit(function() {
		$.ajax({
			type: "POST",
			url: BASE_URL + "Pendencia/confirmValidarPendencia",
			dataType: "json",
			data: $(this).serialize(),
			beforeSend: function() {
				clearErros();
				$("#btn_save_user").siblings(".help-block").html(loadingImg("Verificando..."));
			},
			success: function(response) {
				clearErros();
				if (response["status"]==1) {
					$("#editarUsuario").modal("hide");
					swal({
						title: "Sucesso!",
						text: "Pendência validada com sucesso",
						type: "success",
						confirmButtonText: "Ok",
						closeOnConfirm: true,
					}).then((result) => {
						if (result.value) {
							setTimeout(function(){location.reload(); }, 0);
						}
					})
				} else if(response["status"]==2){
					//permisão negada
					permissao();
				}

				else {
					showErrorsUser(response["error_list"])
				}
			}
		})
		return false;
	});


	var acompanharPendencia = $("#acompanharPendencia").DataTable({
		"oLanguage": DATATABLE_PTBR,
		"autoWidth": false,
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": BASE_URL + "Pendencia/ajaxAcompanharPendencia",
			"type": "POST",
		},
		"columnDefs":[
		{targets: "no-sort", orderable: false},
		{targets: "dt-center", className: "dt-center"},
		],
		"drawCallback": function(){
			active_btn_acompanharPendencia();
		}
	})

	function active_btn_acompanharPendencia() {
		
		$(".btn-edit-acompanharPendencia").click(function(){
			$.ajax({
				type: "POST",
				url: BASE_URL + "Pendencia/editarAcompanharPendencia",
				dataType: "json",
				data: {"idpendencia": $(this).attr("idpendencia")},

				success: function(response) {		
					clearErros();
					$("#formAcompanharPendencia")[0].reset();
					$.each(response["input"], function(id, value) {

						$("#"+id).val(value);
						
					});
					clearErros();
					$("#modal_acompnharPendencia").modal();

				}
			})	
		});
	}

	$("#formAcompanharPendencia").submit(function() {
		$.ajax({
			type: "POST",
			url: BASE_URL + "Pendencia/fecharPendencia",
			dataType: "json",
			data: $(this).serialize(),
			beforeSend: function() {
				clearErros();
				$("#btn_save_user").siblings(".help-block").html(loadingImg("Verificando..."));
			},
			success: function(response) {
				clearErros();
				if (response["status"]==1) {
					$("#modal_acompnharPendencia").modal("hide");
					swal({
						title: "Sucesso!",
						text: "Pendência encerrada com sucesso",
						type: "success",
						confirmButtonText: "Ok",
						closeOnConfirm: true,
					}).then((result) => {
						if (result.value) {
							setTimeout(function(){location.reload(); }, 0);
						}
					})
				} else if(response["status"]==2){
					//permisão negada
					permissao();
				}

				else {
					showErrorsUser(response["error_list"])
				}
			}
		})
		return false;
	});

})