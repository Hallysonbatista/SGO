
<?php

class wo_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // $sql = $this->load->database();
    }

    public function relatorioWoFechadas($condicao = null,$dataInicial,$dataFinal) {
        $this->db
                ->select('`sgo`.`wo`.`idwo` AS `idwo`,
        `sgo`.`wo`.`situacao` AS `situacao`,
        `sgo`.`wo`.`wo` AS `wo`,
        `sgo`.`wo`.`status` AS `status`,
         DATE_FORMAT(`dataatribuicao`, "%d/%m/%Y") AS `dataatribuicao`,
        `sgo`.`wo`.`estacao` AS `estacao`,
        `sgo`.`wo`.`detalhamento` AS `detalhamento`,
        DATE_FORMAT(`ate`, "%d/%m/%Y") AS `ate`,
        `sgo`.`wo`.`responsavelTim` AS `responsavelTim`,
         DATE_FORMAT(`datafechamento`, "%d/%m/%Y") AS `datafechamento`,
        `sgo`.`wo`.`horasdeslocamento` AS `horasdeslocamento`,
        `sgo`.`wo`.`horastrabalhadas` AS `horastrabalhadas`,
        `sgo`.`wo`.`horatotal` AS `horatotal`,
        `sgo`.`wo`.`fechamento` AS `fechamento`,
        `sgo`.`wo`.`quantidadetecnicos` AS `quantidadetecnicos`,
        `sgo`.`wo`.`tecnico` AS `tecnico`,
        `sgo`.`users`.`username` AS `nometecnico`,
        `sgo`.`wo`.`observacoes` AS `observacoes`,
        `sgo`.`cidade`.`id` AS `id`,
        `sgo`.`cidade`.`cidade` AS `cidade`,
        `sgo`.`cm`.`idcm` AS `idcm`,
        `sgo`.`cm`.`nomecm` AS `nomecm`,
        `sgo`.`regiao`.`idregiao` AS `idregiao`,
        `sgo`.`regiao`.`nomeregiao` AS `nomeregiao`,
        `sgo`.`estacao`.`nomeestacao` AS `nomeestacao`,
        `sgo`.`estacao`.`endid` AS `endid`')
        ->from('`sgo`.`wo`')
        ->join('`sgo`.`estacao`','`sgo`.`wo`.`estacao` = `sgo`.`estacao`.`idestacao`','inner')
        ->join('`sgo`.`cidade`','`sgo`.`estacao`.`cidade` = `sgo`.`cidade`.`id`','inner')
        ->join('`sgo`.`cm`','`sgo`.`estacao`.`cm_idcm` = `sgo`.`cm`.`idcm`','inner')
        ->join('`sgo`.`regiao`','`sgo`.`cm`.`regiao_idregiao` = `sgo`.`regiao`.`idregiao`','inner')
        ->join('`sgo`.`users`','`sgo`.`wo`.`tecnico` = `sgo`.`users`.`id`','inner')
        ->where('DATE(dataatribuicao) >=', date('Y-m-d',strtotime($dataInicial)))
        ->where('DATE(dataatribuicao) <=', date('Y-m-d',strtotime($dataFinal)))
        ->where($condicao);
        return $this->db->get()->result();
       
    }
    
        public function relatorioWoAbertas($condicao) {
        $this->db
                ->select('`sgo`.`wo`.`idwo` AS `idwo`,
        `sgo`.`wo`.`situacao` AS `situacao`,
        `sgo`.`wo`.`wo` AS `wo`,
        `sgo`.`wo`.`status` AS `status`,
        DATE_FORMAT(`dataatribuicao`, "%d/%m/%Y") AS `dataatribuicao`,
        `sgo`.`wo`.`estacao` AS `estacao`,
        `sgo`.`wo`.`detalhamento` AS `detalhamento`,
        DATE_FORMAT(`ate`, "%d/%m/%Y") AS `ate`,
        `sgo`.`wo`.`responsavelTim` AS `responsavelTim`,
        DATE_FORMAT(`datafechamento`, "%d/%m/%Y") AS `datafechamento`,
        `sgo`.`wo`.`horasdeslocamento` AS `horasdeslocamento`,
        `sgo`.`wo`.`horastrabalhadas` AS `horastrabalhadas`,
        `sgo`.`wo`.`horatotal` AS `horatotal`,
        `sgo`.`wo`.`fechamento` AS `fechamento`,
        `sgo`.`wo`.`quantidadetecnicos` AS `quantidadetecnicos`,
        `sgo`.`wo`.`tecnico` AS `tecnico`,
        `sgo`.`users`.`username` AS `nometecnico`,
        `sgo`.`wo`.`observacoes` AS `observacoes`,
        `sgo`.`cidade`.`id` AS `id`,
        `sgo`.`cidade`.`cidade` AS `cidade`,
        `sgo`.`cm`.`idcm` AS `idcm`,
        `sgo`.`cm`.`nomecm` AS `nomecm`,
        `sgo`.`regiao`.`idregiao` AS `idregiao`,
        `sgo`.`regiao`.`nomeregiao` AS `nomeregiao`,
        `sgo`.`estacao`.`nomeestacao` AS `nomeestacao`,
        `sgo`.`estacao`.`endid` AS `endid`')
        ->from('`sgo`.`wo`')
        ->join('`sgo`.`estacao`','`sgo`.`wo`.`estacao` = `sgo`.`estacao`.`idestacao`','inner')
        ->join('`sgo`.`cidade`','`sgo`.`estacao`.`cidade` = `sgo`.`cidade`.`id`','inner')
        ->join('`sgo`.`cm`','`sgo`.`estacao`.`cm_idcm` = `sgo`.`cm`.`idcm`','inner')
        ->join('`sgo`.`regiao`','`sgo`.`cm`.`regiao_idregiao` = `sgo`.`regiao`.`idregiao`','inner')
        ->join('`sgo`.`users`','`sgo`.`wo`.`tecnico` = `sgo`.`users`.`id`','inner')
        ->where($condicao);
        return $this->db->get()->result();
       
    }
}
    