$(function() {
	function permissao(){
		swal("Atenção!", "Voce não tem permissão para executar a ação!!", "warning");
	}
	// carga massiva
	$(document).ready(function(e){
		$("#prevForm").on('submit', function(e){
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: 'Preventiva/ajaxCargaMassiva',
				dataType: "json",
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				beforeSend: function(){
					$('.submitBtn').attr("disabled","disabled");
					$('#prevForm').css("opacity",".5");
				},
				success: function(response) {
					if(response["status"] == "arquivoJaCarregado"){
						swal({
							title: "Atenção!",
							text: "Arquivo incorreto ou Basse já carregada...",
							type: "warning",
							confirmButtonText: "Ok",
							closeOnConfirm: true,
						});
						$('#prevForm').css("opacity","");
						$(".submitBtn").removeAttr("disabled");
					}else if(response["status"] == "naoEncontrado"){
						swal({
							title: "Erro!",
							text: "Carga não realizada",
							type: "error",
							confirmButtonText: "Ok",
							closeOnConfirm: true,
						});
						$('#prevForm').css("opacity","");
						$(".submitBtn").removeAttr("disabled");
						for(var keyVar in response){
							$('.msgError').html('<span style="font-size:18px;color:#34A853">Site não encontrados:</span>');
							$('.statusMsg').html('<span style="font-size:18px;color:#34A853">'+response["siteError"]+'</span>');
						}

					}else if(response["status"] == 'ok'){
						swal({
							title: "Sucesso!",
							text: "Carga realizada com sucesso !!!!",
							type: "success",
							confirmButtonText: "Ok",
							closeOnConfirm: true,
						}).then((result) => {
							if (result.value) {
								setTimeout(function(){location.href= "acompanhamento"; }, 0);
							}
						})
					}else{
						swal({
							title: "Atenção!",
							text: "Favor confirme se o arquivo esta correto e tente novamente!!!!",
							type: "warning",
							confirmButtonText: "Ok",
							closeOnConfirm: true,
						});
						$('#prevForm').css("opacity","");
						$(".submitBtn").removeAttr("disabled");
					}
				}
			});
		});
	});
	//fim carga massiva
	// Atualizar status
	
	// fim atualizar status

	// botoes lista preventiva
	function active_btn_preventiva() {
		
		$(".btn-edit-preventiva").click(function(){
			
			$.ajax({
				type: "POST",
				url: BASE_URL + "Preventiva/ajaxAtualizarPreventiva",
				dataType: "json",
				data: {"idPreventiva": $(this).attr("idPreventiva")},

				success: function(response) {				
					clearErros();
					$("#formListaPreventiva")[0].reset();
					$.each(response["input"], function(id, value) {
						if(id=="statuscontratada"){
							$("select[name="+id+"] option[value="+id+"]").attr("selected",true);
							$("select[name="+id+"]").val(value).change();
						}						
						if(id=="usuario_idusuario"){
							$("select[name="+id+"] option[value="+id+"]").attr("selected",true);
							$("select[name="+id+"]").val(value).change();
						}else{
							$("#"+id).val(value);
						}
						
					});
					clearErros();
					$("#editarPreventiva").modal();

				}
			})			
		});
		$(".btn-del-preventiva").click(function(){			
			idPreventiva = $(this).attr("idPreventiva")
			swal({
				title: "Atenção!",
				text: "Deseja deletar esta preventiva?",
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
						url: BASE_URL + "Preventiva/deletarPreventiva",
						dataType: "json",
						data: {"idPreventiva": idPreventiva},
						success: function(response) {
							if (response["status"] == 1) {
								swal({
									title: "Sucesso!",
									text: "Preventiva deletada com sucesso",
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
	//fim botoes lista preventiva



	//mesFiltro = $('#mesFiltro').val();


	$("#listarPreventivas_submit").submit(function() {

		$.ajax({
			type: "POST",
			url: BASE_URL + "Preventiva/ajaxListePreventivaMes",
			dataType: "json",
			data: $(this).serialize(),			

		})
		setTimeout(function(){location.reload(); }, 0);
		return false;
	});


	var listaPreventiva = $("#listaPreventiva").DataTable({
		"oLanguage": DATATABLE_PTBR,
		"autoWidth": false,
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": BASE_URL + "Preventiva/ajaxListePreventiva",
			"type": "POST",
		},
		"columnDefs":[
		{targets: "no-sort", orderable: false},
		{targets: "dt-center", className: "dt-center"},
		],
		"drawCallback": function(){
			active_btn_preventiva();
		}
	})


	$("#formListaPreventiva").submit(function() {
		$.ajax({
			type: "POST",
			url: BASE_URL + "Preventiva/salvaFormPreventiva",
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
						text: "Preventiva atualizada com sucesso",
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

	$("#FormCargaUnica").submit(function() {
		$.ajax({
			type: "POST",
			url: BASE_URL + "Preventiva/salvarCargaUniva",
			dataType: "json",
			data: $(this).serialize(),
			beforeSend: function() {
				$("#btn_save_user").siblings(".help-block").html(loadingImg("Verificando..."));
			},
			success: function(response) {
				if (response["status"]==1) {
					swal({
						title: "Sucesso!",
						text: "Preventiva cadastrada com sucesso",
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
				}else {
					showErrorsUser(response["error_list"])
				}
			}

		})
		return false;
	});


})


