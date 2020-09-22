<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
                if (!$this->ion_auth->logged_in()) { // validar se usuario esta logado
            redirect('Login');
        }
    }

    public function index() {
      $data = array(
            'styles' => array(
                
            ),
            'scripts' => array(
               
            ),
            'titulo' => 'Home',
            'tituloSuperior' => 'Ezentis',          
        );
//           echo '<pre>';
//           print_r($data['usuarios']);
//           exit();

        $this->load->view("layout/_head", $data);
        $this->load->view("home");
        $this->load->view("layout/_scripts");
    }

}
