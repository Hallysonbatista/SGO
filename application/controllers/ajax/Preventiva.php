<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Preventiva extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function getCm() {
        $this->load->model("crud_model");
        $this->load->helper('functions');
        $id_regiao = $this->input->post('regiao_idregiao');
        sleep(1);
        $cm = $this->crud_model->selectDistinct("*", "cm", "regiao_idregiao ='" . $id_regiao . "'");
        echo functionHtmlOptions('', $cm, 'nomecm', 'nomecm');
    }

    public function cargaPreventivaEstacao() {
        $this->load->model("crud_model");
        $this->load->helper('functions');
        $endId = $this->input->post('endId');
        $sigla = $this->crud_model->select('idestacao,nomeestacao', "estacao", "endid ='" . $endId . "'");
        echo functionHtmlOptions('', $sigla, 'idestacao', 'nomeestacao');
    }

    public function mesAcompanhamentoPreventiva() {
        $this->load->model("crud_model");
        $this->load->helper('functions');
        $contrato = $this->input->post('mesProgramacao');
//                    echo '<pre>';
//            print_r($contrato);
//            exit();
        $mes = $this->crud_model->selectDistinct('mesprogramacao,mesprogramacaooriginal', 'filtropreventivas', array('contrato' => $contrato));
//                            echo '<pre>';
//            print_r($mes);
//            exit();
        echo functionHtmlOptions('', $mes, 'mesprogramacao', 'mesprogramacao');
    }

    public function teste() {
//         $this->load->model("crud_model");
//         $this->load->helper('functions');
//         $endId = $this->input->post('endId');
//         $data = $this->crud_model->selectLinha("endid", "estacao", "endid ='".$endId."'order by idestacao asc limit 1");
// var_dump($data);
//         echo json_encode($data);
    }

}
