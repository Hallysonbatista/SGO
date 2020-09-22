$(function () {
    function permissao() {
        swal("Atenção!", "Voce não tem permissão para executar a ação!!", "warning");
    }

    // botoes lista preventiva
    function active_btn_preventiva() {

        $(".btn-edit-preventiva").click(function () {

            $.ajax({
                type: "POST",
                url: BASE_URL + "Preventiva/ajaxAtualizarPreventiva",
                dataType: "json",
                data: {"idPreventiva": $(this).attr("idPreventiva")},

                success: function (response) {
                    clearErros();
                    $("#formListaPreventiva")[0].reset();
                    $.each(response["input"], function (id, value) {
                        if (id == "statuscontratada") {
                            $("select[name=" + id + "] option[value=" + id + "]").attr("selected", true);
                            $("select[name=" + id + "]").val(value).change();
                        }
                        if (id == "usuario_idusuario") {
                            $("select[name=" + id + "] option[value=" + id + "]").attr("selected", true);
                            $("select[name=" + id + "]").val(value).change();
                        } else {
                            $("#" + id).val(value);
                        }

                    });
                    clearErros();
                    $("#editarPreventiva").modal();

                }
            })
        });
        $(".btn-del-preventiva").click(function () {
            idPreventiva = $(this).attr("idPreventiva")


            Swal.mixin({
                input: 'textarea',
                inputPlaceholder: 'Informe o motivo da exclusão',
                showCancelButton: true,
            }).queue([
                {
                    title: "Atenção!",
                    text: "Deseja deletar esta preventiva?",
                    type: "error",
                },
            ]).then((result) => {
                if (result.value) {
                    const answers = result.value
                    $.ajax({
                        type: "POST",
                        url: BASE_URL + "Preventiva/delet",
                        data: {"idPreventiva": idPreventiva, "observacoes": answers},
                        success: function (response) {
                            window.location.reload();
                        }
                    })

                }
            })



        });

    }
    //fim botoes lista preventiva


    $("#listarPreventivas_submit").submit(function () {

        $.ajax({
            type: "POST",
            url: BASE_URL + "Preventiva/ajaxListePreventivaMes",
            dataType: "json",
            data: $(this).serialize(),
        })
        setTimeout(function () {
            location.reload();
        }, 0);
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
        "columnDefs": [
            {targets: "no-sort", orderable: false},
            {targets: "dt-center", className: "dt-center"},
        ],
        "drawCallback": function () {
            active_btn_preventiva();
        }
    })
})


