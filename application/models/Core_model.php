<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Core_model extends CI_Model {

    public function get_all($tabela = null, $condicao = null) {
        if ($tabela) {
            if (is_array($condicao)) {
                $this->db->where($condicao);
            }
            return $this->db->get($tabela)->result();
        } else {
            return false;
        }
    }

    public function get_by_id($tabela = null, $condicao = null) {
        if ($tabela && is_array($condicao)) {
            $this->db->where($condicao);
            $this->db->limit(1);

            return $this->db->get($tabela)->row();
        } else {
            return false;
        }
    }
    public function ultimaatualizacao($valor,$tabela,$condicao) {
         return $this->db->query("Select MAX($valor) as atualizacao from $tabela WHERE $condicao")->row();
        
    }

    public function insert($tabela = NULL, $data = NULL, $get_last_id = NULL) {
        if ($tabela && is_array($data)) {
            $this->db->insert($tabela, $data);
            if ($get_last_id) {
                $this->session->set_userdata('last_id', $this->db->insert_id());
            }
//            var_dump($this->db->affected_row());
//            if ($this->db->affected_row() > 0) {
//                $this->session->set_flashdata('Sucesso', 'Dados salvos com sucesso');
//            } else {
//                $this->session->set_flashdata('error', 'Erro ao salvar dados');
//            }
        } else {
            
        }
    }

    public function update($tabela = NULL, $data = NULL, $condicao = NULL) {
        if ($tabela && is_array($data) && is_array($condicao)) {
            return $this->db->update($tabela, $data, $condicao);
        }else{
            return FALSE;
        }
    }

    public function delete($tabela = NULL, $condicao = NULL) {
       $this->db->db_debug = FALSE;
        if ($tabela && is_array($condicao)) {
            $status = $this->db->delete($tabela, $condicao);
            $error = $this->db->error();
            if (!$status) {
                foreach ($error as $codigo) {
                    if ($codigo == 1451) {
                        $this->session->set_flashdata('error', 'Este registro não poderá ser excluido, pois esta sendo utilizado em outra tabela');
                    }
                }
            }else{
                $this->session->set_flashdata('Sucesso', 'Registro excluido com sucesso');
            }
            $this->db->db_debug = TRUE;
        } else {
            return false; 
        }
    }

}
