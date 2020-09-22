<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pendencia extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    public function getSubCategoria() {
        $this->load->model("crud_model");
        $this->load->helper('functions');
        $categoria = $this->input->post('categoria');
        // sleep(1);
        $subCategoria = $this->crud_model->selectDistinct("*", "nomesubcategoria", "categoriapendencia_idcategoriapendencia ='".$categoria."'");
        echo functionHtmlOptions('', $subCategoria, 'idsubcategoriapendencia','subcategoriapendenciacol');
    }

}