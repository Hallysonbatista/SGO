<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Crud_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function select($campo, $tabela, $condicao) {
        $this->db
                ->select($campo)
                ->from($tabela)
                ->where($condicao);
        return $this->db->get();
    }

    public function selectPrev($campo, $tabela, $condicao) {
        $this->db
                ->select($campo)
                ->from($tabela)
                ->where($condicao);
        return $this->db->get();
    }

    public function selectDistinct($campo, $tabela, $condicao) {
//       $this->db->query("SET lc_time_names='pt_BR'");            
        $this->db->distinct()
                ->set('SET lc_time_names="pt_BR"')
                ->select($campo)
                ->from($tabela)
                ->where($condicao);
//                ->order_by('mesprogramacaooriginal', 'desc');
        return $this->db->get()->result();
    }

    public function selectLinha($campo, $tabela, $condicao) {
        $this->db
                ->select($campo)
                ->from($tabela)
                ->where($condicao);
        $resultado = $this->db->get();

        if ($resultado->num_rows() > 0) {
            return $resultado->row();
        } else {
            return NULL;
        }
    }

    public function selectLinhaOr($campo, $tabela, $condicao, $condicao2) {
        $this->db
                ->select($campo)
                ->from($tabela)
                ->where($condicao)
                ->or_group_start()
                ->where($condicao2);
        $resultado = $this->db->get();

        if ($resultado->num_rows() > 0) {
            return $resultado->row();
        } else {
            return NULL;
        }
    }

    public function insert($tabela, $data) {
        $this->db
                ->insert($tabela, $data);
    }

    public function update($condicao, $tabela, $array) {
        $this->db->where($condicao);
        $this->db->update($tabela, $array);
    }

    public function isDuplicated($tabela, $condicao, $value, $condicao1, $id = NULL) {
        if (!empty($id)) {
            $this->db->where("'$condicao1'<>", $id);
        }
        $this->db->from($tabela);
        $this->db->where($condicao, $value);
        return $this->db->get()->num_rows() > 0;
    }

    public function delete($tabela, $id) {
        $this->db->where($id);
        $this->db->delete($tabela);
    }

}
