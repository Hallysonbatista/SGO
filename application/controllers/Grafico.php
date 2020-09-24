<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Sao_Paulo');

class Grafico extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) { // validar se usuario esta logado
            redirect('Login');
        }

        $this->load->helper('functions');
        $this->load->model((array('preventiva_model', 'comum_model', 'crud_model')));
        $this->load->library('PHPExcel');
    }

    public function Index() {
        if ($this->input->post('programacao')) {
            $mesprogramacao = $this->input->post('programacao');
        } else {
            $mesprogramacao = date('Y-m-01');
        }
        $data = array(
            "styles" => array(
                "css/dataTables.bootstrap.min.css",
                "css/datatables.min.css"
            ),
            "scripts" => array(
                "chart/Chart.bundle.min.js",
                "chart/chart.js",
                
                "chart/Chart.min.js",

            ),
        );

        $data['titulo'] = 'Lista de preventivas';
        $data['tituloSuperior'] = 'Ezentis - Lista de preventivas';
        $this->load->view("layout/_head", $data);
        $this->load->view("teste/grafico");
        $this->load->view("layout/_scripts");
    }
}