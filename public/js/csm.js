$(function() {

	function active_btn_user() {
		
		$(".btn-edit-ntt").click(function(){
			
			$.ajax({
				type: "POST",
				url: BASE_URL + "Csm/editarNtt",
				dataType: "json",
				data: {"idNtt": $(this).attr("idNtt")},

				success: function(response) {									
					clearErros();
					$("#formListaNtt")[0].reset();
					$.each(response["input"], function(id, value) {
						if(id=="vandalismo"){
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
					$("#editarNtt").modal();
				}
			})			
		});
	}

	var listaUsuario = $("#listaNtt").DataTable({
		"oLanguage": DATATABLE_PTBR,
		"autoWidth": false,
		"processing": true,
		"serverSide": true,
		"ajax": {
			"url": BASE_URL + "Csm/ajaxListeNtt",
			"type": "POST",
		},
		"columnDefs":[
		{targets: "no-sort", orderable: false},
		{targets: "dt-center", className: "dt-center"},
		],
		"drawCallback": function(){
			active_btn_user();
		}
	});

	$(document).ready(function(e){
		$("#formListaNtt").on('submit', function(e){
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: 'Csm/ajaxCargaMassiva',
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


})