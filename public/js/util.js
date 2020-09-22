const BASE_URL = window.location.protocol + "//" + window.location.host + "/" +"ezentis/";
const DATATABLE_PTBR = {
    "sEmptyTable": "Nenhum registro encontrado",
    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
    "sInfoPostFix": "",
    "sInfoThousands": ".",
    "sLengthMenu": "_MENU_ resultados por página",
    "sLoadingRecords": "Carregando...",
    "sProcessing": "Processando...",
    "sZeroRecords": "Nenhum registro encontrado",
    "sSearch": "Pesquisar",
    "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
    },
    "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
    }
}
function permissao(){
  window.onload = function(){
    swal({
        title: "Atenção!",
        text: "Voce não tem permissão para acessar esta pagina!!",
        type: "warning",
        confirmButtonText: "Ok",
        closeOnConfirm: true,
    }).then((result) => {
        setTimeout(location.href= "restrict", 0);
    })
}
}
function clearErros(){
	// $("#alterarSenha").prop("checked", false);
	// $("#senha_1").prop("hidden",true);
	// $("#senha_2").prop("hidden",true);
	$(".is-invalid").removeClass("is-invalid");
	$(".help-block").html("");
}
//ainda não usando
function showErrors(error_list){

	$.each(error_list, function (id,message){
		$(id).parent().parent().addClass("is-invalid");
		$(id).parent().siblings(".help-block").html(message);  

	});
}
//
function showErrorsUser(error_list){
	clearErros();
	$.each(error_list, function (id,message){
		$(id).addClass("is-invalid");
		$(id).siblings(".help-block").html(message);        
	});
}
function loadingImg(message=""){
	return "<div class='col-lg-offcet-6 col-lg-12'><i class='fa-li fa fa-spinner fa-spin'></i>"+message+"</div>";
}

function uploadImg(input_file,img,input_path){
    src_before = img.attr("src");
    img_file = input_file[0].files[0]; // arquivo completo
    form_data.append("image_file",img_file);
    $.ajax({
        url:BASE_URL + "Preventiva/ajaxprevteste",
        dataType: "json",
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: "POST",
        success: function(response){
            clearErros();
            if(response["status"]){
                img.attr("src",response["img_path"]);
            }else{

            }
        }
    })
}