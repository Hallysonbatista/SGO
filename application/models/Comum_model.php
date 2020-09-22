<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Comum_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
 

    public function getRegiaoAll() {
        return $this->db->query("SELECT * FROM regiao WHERE Regiao = 'TSL'");
    }

    public function selectRegiao() {
        $options = "<option value=''>Selcione a região</optin>";
        $regiao = $this->getRegiaoAll();
        foreach ($regiao->result() as $reg) {
            $options .= "<option value={$reg->idRegiao}>{$reg->NomeRegiao}</option>";
        }
        return $options;
    }

    public function getTecAll() {
        $this->db
                ->select("*")
                ->from("usuario");
        return $this->db->get();
    }

    public function selectTecnico() {
        $options = "<option value='1'>Selcione o técnico</optin>";
        $tecnicos = $this->getTecAll();
        foreach ($tecnicos->result() as $tecnico) {
            $options .= "<option value={$tecnico->idUsuario}>{$tecnico->NomeUsuario}</option>";
        }
        return $options;
    }

    public function getCmByIdRegiao($id_regiao) {
                $this->db
                ->select("*")
                ->from("usuario");
        return $this->db->get();
        
        
        return $this->db->query("SELECT * FROM cm WHERE Regiao_idRegiao = $id_regiao");
    }

    public function selectCm($id_regiao) {
        $cms = $this->getCmByIdRegiao($id_regiao);
        // $total_cms = $cms->nun_rows();
        $options = "<option value=''>Selcione o CM</optin>";
        foreach ($cms->result() as $cm) {
            $options .= "<option value={$cm->idCm}>{$cm->NomeCm}</option>";
        }
        return $options;
    }

    public function get_item_distinct($tabela, $option, $filtro, $value) {
        $resmes = $this->db->query("SELECT DISTINCT $filtro,$value FROM $tabela ORDER BY $filtro ASC");
        $options = "<option value=''>$option</optin>";
        foreach ($resmes->result() as $mes) {
            $options .= "<option value={$mes->$value}>{$mes->$filtro}</option>";
        }

        return $options;
    }

    public function get_endid_distinct($tabela, $option, $filtro, $value) {
        $resmes = $this->db->query("SELECT DISTINCT $filtro,$value FROM $tabela ORDER BY $filtro ASC");
        $options = "<option value=$option>$option</optin>";
        foreach ($resmes->result() as $mes) {
            $options .= "<option value={$mes->$filtro}>{$mes->$filtro}</option>";
        }

        return $options;
    }

    public function get_endId($endId) {
        $preventivaUnica = $this->db->query("SELECT COUNT(*)as nun FROM estacoes WHERE EnderecoId  = '$endId'");
        return $preventivaUnica->row();
    }

    public function get_id_endId($endId) {
        $preventivaUnica = $this->db->query("SELECT COUNT(idEstacoes)as cont, idEstacoes FROM estacoes WHERE EnderecoId  = '$endId'");
        return $preventivaUnica->row();
    }

}
