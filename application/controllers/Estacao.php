<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Estacao extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) { // validar se usuario esta logado
            redirect('Login');
        }

        $this->load->helper('functions');
        $this->load->model((array('preventiva_model', 'comum_model', 'crud_model')));
    }

    public function Index() {

        $data = array(
            "styles" => array(
                "css/dataTables.bootstrap.min.css",
                "css/datatables.min.css"
            ),
            "scripts" => array(
                "js/dataTables.bootstrap.min.js",
                "js/datatables.min.js",
                "js/util.js",
                "js/estacao.js",
                "js/pace.min.js",
                "js/pages/pages-data.js",
                "js/pace.min.js",
            ),
        );

        $data['mesSelect'] = functionSelectMes();
//        $data['resumo'] = "Lista de preventivas";
        $data['titulo'] = 'Lista de preventivas';
        $data['tituloSuperior'] = 'Ezentis - Lista de estações';
        $this->load->view("layout/_head", $data);
        $this->load->view("estacao/index");
        $this->load->view("layout/_scripts");
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
                 <a href="' . base_url('estacao/editar?id=' . $estacao->idestacao) . ' "class="editar btn btn-primary">
            <i class="fa fa-edit"></i></a>
            
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

    public function editar() {
        $adm_lid_back = array('admin', 'lider', 'backoffice', 'tecnico');
        if ($this->ion_auth->in_group($adm_lid_back)) {
            $this->form_validation->set_rules('idestacao', 'idestacao', 'required');
            if ($this->form_validation->run()) {

                $data = elements(
                        $array = array(
                    'cm_idcm',
                    'cidade',
                    'codigoenergia',
                        ), $this->input->post()
                );
                if ($this->input->post('cm_idcm') == '') {
                    unset($data['cm_idcm']);
                }
                if ($this->input->post('cidade') == '') {
                    unset($data['cidade']);
                }

                $user = $this->ion_auth->user()->row();
                $data['usuariomod'] = $user->first_name;
//            echo '<pre>';
//            print_r($data);
//            exit();
                $data = html_escape($data); //limpar possiveis codigos maliciosos do input
                $condicao['endid'] = html_escape($this->input->post('endid'));

                if ($this->Core_model->update('estacao', $data, $condicao)) {
                    $this->session->set_flashdata('sucesso', 'Dados atualizados com sucesso');
                    redirect('estacao');
                } else {
                    $this->session->set_flashdata('error', 'Erro ao atualizadosos dados da preventiva');
                }
            }
            $data['perfil_usuario_logado'] = $this->ion_auth->get_users_groups()->row();
            $idestacao = $this->input->get('id');
            $data['estacao'] = $this->Core_model->get_by_id('filtroestacoes', array('idestacao' => $idestacao));
            $data['cidade'] = $this->Core_model->get_all('cidade', array());
            $data['cm'] = $this->Core_model->get_all('cm', array());
//        echo '<pre>';
//        print_r($data['status']);
//        exit();
            $data['titulo'] = 'Editar Estação';
            $data['tituloSuperior'] = 'Ezentis - Editar Estação';
            $this->load->view("layout/_head", $data);
            $this->load->view("estacao/edit");
            $this->load->view("layout/_scripts");
        } else {
            $this->session->set_flashdata('error', 'Você não tem permisão acessar esta página!!');
            redirect('preventiva');
        }
    }

}
