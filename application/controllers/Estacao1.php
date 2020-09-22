<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Sao_Paulo');

class Estacao extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('functions');
        $this->load->model('crud_model');
        $this->load->library('encryption');
    }

    public function listarEstacao() {
        $acesso = $this->session->userdata("nAcesso");
        if($acesso >= 3){
            $data = array(
                "styles" => array(
                    "dataTables.bootstrap.min.css",
                    "datatables.min.css"
                ),
                "scripts" => array(
                    "sweetalert2.all.min.js",                
                    "datatables.min.js",
                    "util.js",
                    "estacao.js",
                ),
            );
            $data['cm'] = functionSelectCm();
            $data['cidade'] = functionHtmlOptions('', $this->crud_model->selectDistinct('cidade', 'cidade', 'id !=""'), 'cidade', 'cidade');
            $data['resumo'] = "Lista de Estações";
            $this->template->show("estacao/listarEstacao", $data);
        }else{?>
            <script src="<?= base_url() ?>public/js/sweetalert2.all.min.js"></script>
            <script type="text/javascript">
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
            </script>
            <?php

        }
    }

    public function ajaxListeEstacao() {
        if (!$this->input->is_ajax_request()) {
            exit("Nenhum acesso de script direto permitido!");
        }

        $this->load->model("estacaoDatatable_model");
        $estacoes = $this->estacaoDatatable_model->get_datatable();

        $data = array();
        foreach ($estacoes as $estacao) {
            $row = array();
            $row[] = $estacao->endid;
            $row[] = $estacao->nomeestacao;
            $row[] = $estacao->uf;
            $row[] = $estacao->cidade;
            $row[] = $estacao->nomecm;
            $row[] = '<div style="display: inline-block;">
            <button class="btn btn-primary btn-edit-estacao" 
            idEstacao="' . $estacao->idestacao . '">
            <i class="fa fa-edit"></i>
            </button>
            </div>';
            $data[] = $row;
        }

        $json = array(
            "draw" => $this->input->post("draw"),
            "recordsTotal" => $this->estacaoDatatable_model->records_total(),
            "recordsFiltered" => $this->estacaoDatatable_model->records_filtered(),
            "data" => $data,
        );

        echo json_encode($json);
    }

    public function editarEstacao() {

        if (!$this->input->is_ajax_request()) {
            exit("Nenhum acesso de script direto permitido!");
        }
        $json = array();
        $json["status"] = 1;
        $json["input"] = array();
        $idestacao = $this->input->post("idEstacao");
        $data = $this->crud_model->select("*", "filtroestacoes", "idestacao=" . $idestacao)->result_array()[0];
        $json["input"]["detentoraarea"] = $data["detentoraarea"];
        $json["input"]["cm_idcm"] = $data["cm_idcm"];
        $json["input"]["endid1"] = $data["endid"];
        $json["input"]["endid"] = $data["endid"];
        $json["input"]["cidade"] = $data["cidade"];
        $json["input"]["uf"] = $data["uf"];
        $json["input"]["codigoenergia"] = $data["codigoenergia"];
        $json["input"]["hora"] = $data["hora"];
        $json["input"]["km"] = $data["km"];
        $json["input"]["detentoraarea"] = $data["detentoraarea"];

        echo json_encode($json);
    }

    public function saveEstacao() {

        $json = array();
        $json["status"] = 1;
        $json["error_list"] = array();
        $data = $this->input->post();
        $acesso = $this->session->userdata("nAcesso");
        if($acesso == 4 || $acesso == 8 || $acesso == 9){

            if (empty($data["endid"])) {
                $json["error_list"]["#endid1"] = "Atualiza a pagina e refaça a operação!";
            }
            if (empty($data["km"])) {
                $json["error_list"]["#km"] = "Km é obrigatório!";
            }
            if (empty($data["hora"])) {
                $json["error_list"]["#hora"] = "Hora é obrigatório!";
            }
            if (empty($data["uf"])) {
                $json["error_list"]["#uf"] = "UF é obrigatório!";
            }
            if (empty($data["cm_idcm"])) {
                $json["error_list"]["#cm_idcm"] = "SUB CM é obrigatório!";
            }
            if (empty($data["cidade"])) {
                $json["error_list"]["#cidade"] = "Cidade é obrigatório!";
            }
            if (!empty($json["error_list"])) {
                $json["status"] = 2;
            }else {
                $json["status"] = 0;
                $end = $data["endid"];
                $data["usuariomod"] = $this->session->userdata("idusuario");
                $data["datamod"] = date("Y-m-d H:i:s");
                unset($data["endid"]);
             // var_dump($data);
                $this->crud_model->update("endid = '".$end."'","estacao", $data);
            }
        }
        // var_dump($json["error_list"]);
        echo json_encode($json);
    }

    public function cadastrarEstacao() {
        $acesso = $this->session->userdata("nAcesso");
        if($acesso == 4 || $acesso == 8 || $acesso == 9){
            $data = array(
                "styles" => array(
                    "dataTables.bootstrap.min.css",
                    "datatables.min.css"
                ),
                "scripts" => array(
                    "sweetalert2.all.min.js",                
                    "datatables.min.js",
                    "util.js",
                    "estacao.js",
                ),
            );
            $data['cm'] = functionSelectCm();
            $data['cidade'] = functionHtmlOptions('', $this->crud_model->selectDistinct('cidade', 'cidade', 'id !=""'), 'cidade', 'cidade');
            $data['resumo'] = "Cadastrar Estações";
            $this->template->show("estacao/cadastrarEstacao", $data);
        }else{?>
            <script src="<?= base_url() ?>public/js/sweetalert2.all.min.js"></script>
            <script type="text/javascript">
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
            </script>
            <?php

        }
    }

    public function saveNovaEstacao() {
        $json = array();
        $json["status"] = 1;
        $json["error_list"] = array();
        $data = $this->input->post();
        if (empty($data["endid"])) {
            $json["error_list"]["#endid"] = "End Id é obrigatório!";
        }
        if (empty($data["km"])) {
            $json["error_list"]["#km"] = "Km é obrigatório!";
        }
        if (empty($data["hora"])) {
            $json["error_list"]["#hora"] = "Hora é obrigatório!";
        }
        if (empty($data["uf"])) {
            $json["error_list"]["#uf"] = "UF é obrigatório!";
        }
        if (empty($data["cm_idcm"])) {
            $json["error_list"]["#cm_idcm"] = "SUB CM é obrigatório!";
        }
        if (empty($data["cidade"])) {
            $json["error_list"]["#cidade"] = "Cidade é obrigatório!";
        }
        if (!empty($json["error_list"])) {
            $json["status"] = 0;
        }
        else {
            $data["usuariomod"] = $this->session->userdata("idusuario");
            $data["datamod"] = date("Y-m-d H:i:s");
              // var_dump($data);
            $this->crud_model->insert("estacao", $data);
        }

        echo json_encode($json);
    }
}
