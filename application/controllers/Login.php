<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('login/index');
    }

// autenticação
    public function auth() {

        $identity = $this->security->xss_clean($this->input->post('usuario'));
        $password = $this->security->xss_clean($this->input->post('Senha'));
        $remember = false; // remember the user
        $this->ion_auth_model->identity_column = 'first_name'; // escolher por qual caminho vai efetuar o login
        if ($this->ion_auth->login($identity, $password, $remember)) {
            redirect('home');
        } else {
            $this->session->set_flashdata('error', 'verifique seu e-mail ou senha!!');
            redirect('Login');
        }
    }
    
    public function logout(){
        if($this->ion_auth->logout()){
            redirect('Login');
        }
        
    }

}
