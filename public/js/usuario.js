$(function() {

	$("#FormCadastro").submit(function() {

		$.ajax({			
			type: "POST",
			url: BASE_URL + "Usuario/saveUser",
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
						text: "Usuario cadastrado com sucesso",
						html: 'Seu login é: <br/><br/>'+
						'<h2>' + response["login"] + '</h2>',
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

	$("#perfil").click(function() {
		$.ajax({
			type: "POST",
			url: BASE_URL + "usuario/editPerfil",
			dataType: "json",
			success: function(response) {
				clearErros();

				$.each(response["input"], function(id, value) {
					$("#"+id).val(value);
				});
				clearErros();

				$("#modal_perfil").modal();
			}
		})
		return false;
	});

	$("#form_perfil").submit(function() {
		$.ajax({
			type: "POST",
			url: BASE_URL + "Usuario/salvaPerfil",
			dataType: "json",
			data: $(this).serialize(),
			beforeSend: function() {
				clearErros();
				$("#btn_save_user").siblings(".help-block").html(loadingImg("Verificando..."));
			},
			success: function(response) {
				clearErros();
				if (response["status"]) {
					$("#modal_perfil").modal("hide");
					swal("Sucesso!","Usuário alterado com sucesso!", "success");					
				} else {

					showErrorsUser(response["error_list"])
				}
			}
		})

		return false;
	});

	function permissao(){

		swal("Atenção!", "Voce não tem permissão para executar a ação!!", "warning");
	}

	function active_btn_user() {
		
		$(".btn-edit-usuario").click(function(){
			
			$.ajax({
				type: "POST",
				url: BASE_URL + "usuario/editarUsuario",
				dataType: "json",
				data: {"idusuario": $(this).attr("idusuario")},

				success: function(response) {				
					clearErros();
					$("#formListaUsuario")[0].reset();
					$.each(response["input"], function(id, value) {

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
					clearErros();
					$("#editarUsuario").modal();

				}
			})			
		});
		$(".btn-del-usuario").click(function(){
			
			idusuario = $(this).attr("idusuario")
			swal({
				title: "Atenção!",
				text: "Deseja deletar este usuário?",
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
						url: BASE_URL + "usuario/deletarUsuario",
						dataType: "json",
						data: {"idusuario": idusuario},
						success: function(response) {
							if (response["status"] == 1) {
								swal({
									title: "Sucesso!",
									text: "Usuario deletado com sucesso",
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

	var listaUsuario = $("#listaUsuario").DataTable({
		"oLanguage": DATATABLE_PTBR,
		"autoWidth": false,
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": BASE_URL + "Usuario/ajaxListeUsuario",
			"type": "POST",
		},
		"columnDefs":[
		{targets: "no-sort", orderable: false},
		{targets: "dt-center", className: "dt-center"},
		],
		"drawCallback": function(){
			active_btn_user();
		}
	})

	$("#formListaUsuario").submit(function() {
		$.ajax({
			type: "POST",
			url: BASE_URL + "Usuario/salvaFormUsuario",
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
						text: "Usuario alterado com sucesso",
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