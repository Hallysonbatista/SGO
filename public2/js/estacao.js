$(function() {

	function permissao(){

		swal("Atenção!", "Voce não tem permissão para executar a ação!!", "warning");
	}

	function active_btn_estacao() {
		
		$(".btn-edit-estacao").click(function(){
			
			$.ajax({
				type: "POST",
				url: BASE_URL + "Estacao/editar",
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

})