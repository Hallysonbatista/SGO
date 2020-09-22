<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class teste extends CI_Controller {

    public function __construct() {
        parent::__construct();
//        if (!$this->ion_auth->logged_in()) {
//            redirect('Login/Login');
//        }
    }

    public function Index() {
        $adm_lid = array('admin', 'lider'); // administrador e lider
        $coor_back = array('coordenador', 'backoffice'); // administrador e lider
        // if ($this->ion_auth->in_group($adm_lid)) {
        //     $usuarios = $this->ion_auth->users()->result();
        // } elseif ($this->ion_auth->in_group($coor_back)) {
        //      $usuarios = $this->ion_auth->where('active', 1)->users()->result();
        //  } else {
        $usuarios = $this->ion_auth->users()->result();
        //  }
        $data = array(
            'styles' => array(
                "css/dataTables.bootstrap.min.css",
                "css/datatables.min.css"
            ),
            'scripts' => array(
                "plugins/charts/sparklines/jquery.sparkline.js",
                "plugins/tables/datatables/jquery.dataTables.js",
                "plugins/tables/datatables/dataTables.tableTools.js",
                "plugins/tables/datatables/dataTables.bootstrap.js",
                "plugins/tables/datatables/dataTables.responsive.js",
                "js/jquery.dynamic.js",
                "js/main.js",
                "js/pages/tables-data.js"
            ),
            'titulo' => 'Lista de usuários',
            'tituloSuperior' => 'Ezentis - Lista de usuários',
            'usuarios' => $usuarios, // -> todos os usuarios;
        );
        //   echo '<pre>';
        //   print_r($data['usuarios']);
        //   exit();

        $this->load->view("layout/_head", $data);
        $this->load->view("teste/index");
        $this->load->view("layout/_scripts");
    }

    public function Edit($user_id = null) {
        if (!$user_id || !$this->ion_auth->user($user_id)->row()) {
            // $this->session->set_flashdata('error', 'Usuario não encontrado');
            redirect('Usuario/Usuario');
        } else {
            $this->form_validation->set_rules('username', 'Nome', 'trim|required');
            $this->form_validation->set_rules('cpf', '', 'trim|required|callback_cpf_check');
            $this->form_validation->set_rules('matricula', '', 'trim|required|callback_matricula_check');
            $this->form_validation->set_rules('cm', '', 'trim|required');
            $this->form_validation->set_rules('phone', 'telefone', 'trim|required');
            $this->form_validation->set_rules('email', '', 'trim|required|valid_email|callback_email_check');
            $this->form_validation->set_rules('active', '', 'trim|required');
            $this->form_validation->set_rules('perfil_usuario', '', 'trim|required');
            $this->form_validation->set_rules('password', 'senha', 'min_length[4]|max_length[20]');
            $this->form_validation->set_rules('confirm_password', 'confirmar senha', 'matches[password]');

            if ($this->form_validation->run()) {
                $data = elements(
                        array(
                            'username',
                            'cpf',
                            'matricula',
                            'cm',
                            'phone',
                            'email',
                            'active',
                            'password'
                        ), $this->input->post()
                );
                $data = html_escape($data); //limpar possiveis codigos maliciosos do input
                /* verifica se foi atualizado a senha */
                $password = $this->input->post('password');
                if (!$password) {
                    unset($data['password']);
                }

                /* FIM verifica se foi atualizado a senha */
                if ($this->ion_auth->update($user_id, $data)) { //update da tabela.
                    /* perfil do usuario */
                    $perfil_usuario_db = $this->ion_auth->get_users_groups($user_id)->row();
                    $perfil_usuario_post = $this->input->post('perfil_usuario');

                    /* se for diferente atualiza o grupo */
                    if ($perfil_usuario_post != $perfil_usuario_db->id) {
                        $this->ion_auth->remove_from_group($perfil_usuario_db->id, $user_id);
                        $this->ion_auth->add_to_group($perfil_usuario_post, $user_id);
                    }
                    /* FIM inserte (diferente atualiza o grupo) */
                    $this->session->set_flashdata('sucesso', 'Dados atualizados com sucesso');
                } else {
                    $this->session->set_flashdata('error', 'Erro ao atualizadosos dados do usuário');
                }
                redirect('Usuario/Usuario');
            } else {

                $usuraio = $this->ion_auth->user()->row();
                $data = array(
                    'styles' => array(
                        'vendor/datatables/dataTables.bootstrap4.min.css'
                    ),
                    'scripts' => array(
                        'jQuery/Mask/jquery.mask.min.js',
                        'jQuery/Mask/app.js'
                    ),
                    'usuario' => $usuraio,
                    'perfil_usuario' => $this->ion_auth->get_users_groups($user_id)->row(),
                    'cms' => $this->Core_model->get_all('cm', array('')),
                    'cmselect' => $this->Core_model->get_by_id('cm', array('cmId' => $usuraio->cm_cmId)),
                    'titulo' => 'Ezentis',
                    'tituloSuperior' => 'Ezentis - Editar usuário',
                );
                $this->load->view("layout/_head", $data);
                $this->load->view("usuarios/edit");
                $this->load->view("layout/_scripts");
            }
        }
    }

    public function Add() {
        $adm_lid = array('admin', 'lider');
        if (!$this->ion_auth->in_group($adm_lid)) {
            $this->session->set_flashdata('info', 'Você não tem permisão para cadastrar usuário!!');
            redirect('Home');
        }

        $this->form_validation->set_rules('first_name', 'Nome', 'trim|required');
        $this->form_validation->set_rules('cpf', '', 'trim|required|is_unique[users.cpf]');
        $this->form_validation->set_rules('matricula', '', 'trim|required|is_unique[users.matricula]');
        $this->form_validation->set_rules('cm', '', 'required');
        $this->form_validation->set_rules('phone', 'telefone', 'trim|required');
        $this->form_validation->set_rules('email', '', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('active', '', 'required');
        $this->form_validation->set_rules('perfil_usuario', 'perfil do usuário', 'required');
        // $this->form_validation->set_rules('password', 'senha', 'min_length[4]|max_length[20]');
        // $this->form_validation->set_rules('confirm_password', 'confirmar senha', 'matches[password]');
        if ($this->form_validation->run()) {

            $login = explode('@', $this->security->xss_clean($this->input->post('email')));
            $login = $login[0];
            $username = $login;
            $password = 'ezentis';
            $email = $this->security->xss_clean($this->input->post('email'));

            $additional_data = array(
                'username' => $this->input->post('first_name'),
                'first_name' => $username,
                'cpf' => $this->input->post('cpf'),
                'matricula' => $this->input->post('matricula'),
                'cm_cmId' => $this->input->post('cm'),
                'phone' => $this->input->post('phone'),
                'active' => $this->input->post('active'),
            );
// echo '<pre>';
//                    print_r($additional_data);
//                    exit();
            $group = array($this->input->post('perfil_usuario')); // Sets user to admin.
            $additional_data = $this->security->xss_clean($additional_data);
            $group = $this->security->xss_clean($group);
//                    echo '<pre>';
//                    print_r($additional_data);
//                    exit();
            if ($this->ion_auth->register($username, $password, $email, $additional_data, $group)) {
                $this->session->set_flashdata('sucesso', 'Usuario cadastrado com sucesso');
            } else {
                $this->session->set_flashdata('error', 'Erro ao cadastrar o usuário');
            }
            redirect('Usuario');
        } else {
            //erro de validação
            $data = array(
                'cms' => $this->Core_model->get_all('cm', array('')),
                'titulo' => 'Ezentis',
                'tituloSuperior' => 'Ezentis - TSL',
                'scripts' => array(
                    'jQuery/Mask/jquery.mask.min.js',
                    'jQuery/Mask/app.js'
                ),
            );
            $this->load->view("layout/_head", $data);
            $this->load->view("usuarios/add");
            $this->load->view("layout/_scripts");
        }
    }

    public function matricula_check($matricula) {
        $usuario_id = $this->input->post('usuario_id');
        if ($this->Core_model->get_by_id('users', array('matricula' => $matricula, 'id !=' => $usuario_id))) {
            $this->form_validation->set_message('matricula_check', 'Esta matrícula já existe');
            return false;
        } else {
            return true;
        }
    }

    public function email_check($email) {
        $usuario_id = $this->input->post('usuario_id');
        if ($this->Core_model->get_by_id('users', array('email' => $email, 'id !=' => $usuario_id))) {
            $this->form_validation->set_message('email_check', 'Este e-mail já existe');
            return false;
        } else {
            return true;
        }
    }

    public function cpf_check($cpf) {
        $usuario_id = $this->input->post('usuario_id');
        if ($this->Core_model->get_by_id('users', array('cpf' => $cpf, 'id !=' => $usuario_id))) {
            $this->form_validation->set_message('cpf_check', 'Este cpf já existe');
            return false;
        } else {
            return true;
        }
    }

}
