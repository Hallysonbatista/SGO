<?php

class Preventiva_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // $sql = $this->load->database();
    }

    public function get_all($condicao = null) {

        $this->db->select([
            'preventiva.*',
            'users.username',
            'estacao.endid',
            'estacao.nomeestacao',
            'cm.idcm',
            'cm.nomecm',
            'regiao.idregiao',
            'regiao.nomeregiao'
        ]);

        $this->db->join('users', 'users.id = preventiva.usersid');
        $this->db->join('estacao', 'estacao.idestacao = preventiva.estacao_idestacao');
        $this->db->join('cm', 'cm.idcm = estacao.cm_idcm');
        $this->db->join('regiao', 'regiao.idregiao = cm.regiao_idregiao');



        $this->db->where($condicao);
        return $this->db->get('filtropreventivas')->result();
    }

    public function get_atualizacao_status_all($condicao = null) {
        $this->db
                ->select("sgmp,alvo,origemdemanda,contrato,acompanhamento,mesprogramacao,usersid")
                ->from("preventiva")
                ->where($condicao);
        return $this->db->get()->row();
    }

    public function get_acompanhamento_all($param) {
        return $this->db->query("SELECT nomeregiao ,COUNT(statuspreventiva) as geral,
(SELECT COUNT(statuspreventiva) AS analise FROM filtropreventivas as analise WHERE preventivas.regiao_idregiao = analise.regiao_idregiao AND statuspreventiva = 2 AND $param) AS analise,
(SELECT COUNT(statuspreventiva) AS aprovada FROM filtropreventivas as aprovada WHERE preventivas.regiao_idregiao = aprovada.regiao_idregiao AND statuspreventiva = 3 AND $param) AS aprovada,
(SELECT COUNT(statuspreventiva) AS rejeitada FROM filtropreventivas as rejeitada WHERE preventivas.regiao_idregiao = rejeitada.regiao_idregiao AND statuspreventiva = 4 AND $param) AS rejeitada,
(SELECT COUNT(statuspreventiva) AS suspensa FROM filtropreventivas as suspensa WHERE preventivas.regiao_idregiao = suspensa.regiao_idregiao AND statuspreventiva = 5 AND $param) AS suspensa,
(SELECT COUNT(DISTINCT endid) AS endid FROM filtropreventivas AS endid WHERE preventivas.regiao_idregiao = endid.regiao_idregiao AND statuspreventiva != 1 AND $param) AS endid
FROM filtropreventivas as preventivas WHERE statuspreventiva != 1 AND $param GROUP BY nomeregiao")->result();
         
    }

}

//
//
//public function get_acompanhamento_geral($condicao, $mes,$alvo) {
//    $result = $this->db->query("SELECT nomeregiao, uf,COUNT(nomeregiao)as prog, SUM(sinalizacao) as improdutivo , 
//        (select COUNT(1) from filtropreventivas as a1 where a2.nomeregiao = a1.nomeregiao and a1.statuscontratada =  'Rejeitada' AND a1.mesprogramacao = '$mes' AND $alvo )as rej,
//        (SELECT COUNT(1) FROM filtropreventivas as a3 WHERE a2.nomeregiao = a3.nomeregiao AND a3.statuscontratada = 'Executada' AND a3.mesprogramacao = '$mes' AND $alvo ) as exec,
//        (SELECT COUNT(1) FROM filtropreventivas as analise WHERE a2.nomeregiao = analise.nomeregiao AND analise.statuscontratada = 'Analise' AND analise.mesprogramacao = '$mes' AND $alvo ) as analise, 
//        (SELECT COUNT(1) FROM filtropreventivas as infra WHERE a2.nomeregiao = infra.nomeregiao and infra.alvo = 'Infraestrutura Geral' and infra.mesprogramacao='$mes' AND $alvo) as proginfra,
//        (SELECT COUNT(1) FROM filtropreventivas as analiseinfra WHERE a2.nomeregiao = analiseinfra.nomeregiao and analiseinfra.alvo = 'Infraestrutura Geral' and analiseinfra.statuscontratada ='Analise' and analiseinfra.mesprogramacao='$mes' AND $alvo) as analiseinfra,
//        (select COUNT(1) from filtropreventivas as rejinfra where a2.nomeregiao = rejinfra.nomeregiao and rejinfra.statuscontratada =  'Rejeitada' AND alvo = 'Infraestrutura Geral' and rejinfra.mesprogramacao = '$mes' AND $alvo)as rejinfra,
//        (SELECT COUNT(1) FROM filtropreventivas as execinfra WHERE a2.nomeregiao = execinfra.nomeregiao AND execinfra.statuscontratada = 'Executada' AND execinfra.alvo = 'Infraestrutura Geral' and execinfra.mesprogramacao = '$mes' AND $alvo) as execinfra,
//        (SELECT COUNT(1) FROM filtropreventivas as improinfra WHERE a2.nomeregiao = improinfra.nomeregiao AND improinfra.sinalizacao = 1 AND improinfra.alvo = 'Infraestrutura Geral' and improinfra.mesprogramacao = '$mes' AND $alvo) as improinfra,
//        (SELECT COUNT(1) FROM filtropreventivas as acesso WHERE a2.nomeregiao = acesso.nomeregiao and acesso.alvo = 'EQUIPAMENTO DE ACESSO' and acesso.mesprogramacao='$mes' AND $alvo) as progacesso,
//        (SELECT COUNT(1) FROM filtropreventivas as analiseacesso WHERE a2.nomeregiao = analiseacesso.nomeregiao and analiseacesso.alvo = 'EQUIPAMENTO DE ACESSO' and analiseacesso.statuscontratada ='Analise' and analiseacesso.mesprogramacao='$mes' AND $alvo) as analiseacesso,
//        (select COUNT(1) from filtropreventivas as rejacesso where a2.nomeregiao = rejacesso.nomeregiao and rejacesso.statuscontratada =  'Rejeitada' AND alvo = 'EQUIPAMENTO DE ACESSO' and rejacesso.mesprogramacao = '$mes' AND $alvo)as rejacesso,
//        (SELECT COUNT(1) FROM filtropreventivas as execacesso WHERE a2.nomeregiao = execacesso.nomeregiao AND execacesso.statuscontratada = 'Executada' AND execacesso.alvo = 'EQUIPAMENTO DE ACESSO' and execacesso.mesprogramacao = '$mes' AND $alvo ) as execacesso,
//        (SELECT COUNT(1) FROM filtropreventivas as improacesso WHERE a2.nomeregiao = improacesso.nomeregiao AND improacesso.sinalizacao = 1 AND improacesso.alvo = 'EQUIPAMENTO DE ACESSO' and improacesso.mesprogramacao = '$mes' AND $alvo ) as improacesso,
//        (SELECT COUNT(1) FROM filtropreventivas as mw WHERE a2.nomeregiao = mw.nomeregiao and mw.alvo = 'EQUIPAMENTO DE MW' and mw.mesprogramacao='$mes' AND $alvo) as progmw,
//        (SELECT COUNT(1) FROM filtropreventivas as analisemw WHERE a2.nomeregiao = analisemw.nomeregiao and analisemw.alvo = 'EQUIPAMENTO DE MW' and analisemw.statuscontratada ='Analise' and analisemw.mesprogramacao='$mes' AND $alvo) as analisemw,
//        (select COUNT(1) from filtropreventivas as rejmw where a2.nomeregiao = rejmw.nomeregiao and rejmw.statuscontratada =  'Rejeitada' AND alvo = 'EQUIPAMENTO DE MW' and rejmw.mesprogramacao = '$mes' AND $alvo)as rejmw,
//        (SELECT COUNT(1) FROM filtropreventivas as execmw WHERE a2.nomeregiao = execmw.nomeregiao AND execmw.statuscontratada = 'Executada' AND execmw.alvo = 'EQUIPAMENTO DE MW' and execmw.mesprogramacao = '$mes' AND $alvo) as execmw,
//        (SELECT COUNT(1) FROM filtropreventivas as impromw WHERE a2.nomeregiao = impromw.nomeregiao AND impromw.sinalizacao = 1 AND impromw.alvo = 'EQUIPAMENTO DE MW' and impromw.mesprogramacao = '$mes' AND $alvo) as impromw
//        FROM filtropreventivas as a2 
//        WHERE $condicao
//        GROUP BY nomeregiao 
//        ORDER BY uf");
//return $result;
//}
//public function get_acompanhamento_zeladoria($condicao, $mes,$alvo) {
//    $result = $this->db->query("SELECT nomeregiao, uf,COUNT(nomeregiao)as progZeladoria, SUM(sinalizacao) as improZeladoria , 
//        (select COUNT(1) from filtropreventivas as a1 where a2.nomeregiao = a1.nomeregiao and a1.statuscontratada =  'Rejeitada' AND a1.mesprogramacao = '$mes' AND $alvo )as rejZeladoria,
//        (SELECT COUNT(1) FROM filtropreventivas as a3 WHERE a2.nomeregiao = a3.nomeregiao AND a3.statuscontratada = 'Executada' AND a3.mesprogramacao = '$mes' AND $alvo ) as execZeladoria,
//        (SELECT COUNT(1) FROM filtropreventivas as analise WHERE a2.nomeregiao = analise.nomeregiao AND analise.statuscontratada = 'Analise' AND analise.mesprogramacao = '$mes' AND $alvo ) as analiseZeladoria
//        FROM filtropreventivas as a2 
//        WHERE $condicao
//        GROUP BY nomeregiao 
//        ORDER BY uf");
//    return $result;
//}
//
//public function get_acompanhamento_Fmt($condicao, $mes,$alvo) {
//    $result = $this->db->query("SELECT nomeregiao, uf,COUNT(nomeregiao)as progFmt, SUM(sinalizacao) as improFmt , 
//        (select COUNT(1) from filtropreventivas as a1 where a2.nomeregiao = a1.nomeregiao and a1.statuscontratada =  'Rejeitada' AND a1.mesprogramacao = '$mes' AND $alvo )as rejFmt,
//        (SELECT COUNT(1) FROM filtropreventivas as a3 WHERE a2.nomeregiao = a3.nomeregiao AND a3.statuscontratada = 'Executada' AND a3.mesprogramacao = '$mes' AND $alvo ) as execFmt,
//        (SELECT COUNT(1) FROM filtropreventivas as analise WHERE a2.nomeregiao = analise.nomeregiao AND analise.statuscontratada = 'Analise' AND analise.mesprogramacao = '$mes' AND $alvo ) as analiseFmt
//        FROM filtropreventivas as a2 
//        WHERE $condicao
//        GROUP BY nomeregiao 
//        ORDER BY uf");
//    return $result;
//}
//
//public function get_Preventiva_distinct($option, $filtro) {
//    $resmes = $this->db->query("SELECT DISTINCT $filtro FROM filtropreventivas ORDER BY $filtro ASC");
//    $options = "<option value='".$option."'>$option</optin>";
//    foreach ($resmes->result() as $mes) {
//        $options .= "<option value='{$mes->$filtro}'>{$mes->$filtro}</option>";
//    }
//    return $options;
//}
//
//public function get_preventiva_geral($mes) {
//    $resmes = $this->db->query("SELECT * FROM filtropreve WHERE MesProg  = '$mes'");
//    return $resmes;
//}
//
//public function get_preventiva_unica($id) {
//    $preventivaUnica = $this->db->query("SELECT * FROM filtropreve WHERE id  = '$id'");
//    return $preventivaUnica->row();
//}
//
//public function get_relatorio_preventiva($stringArray) {
//    $resmes = $this->db->query("SELECT * FROM filtropreve WHERE $stringArray");
//    return $resmes;
//}
//
//public function get_status_preventiva($mes, $idSgmp) {
//    $resmes = $this->db->query("SELECT * FROM `preventiva` WHERE MesProg = '$mes' AND idPreventiva = $idSgmp");
//    return $resmes;
//}
//
//public function set_status_preventiva($mes, $idSgmp) {
//    $resmes = $this->db->query("UPDATE preventiva SET StatusEzentis='Analise' WHERE MesProg = '$mes' AND idPreventiva = $idSgmp");
//    return $resmes;
//}
//
//public function insertPreventivaAtualizacao($DataExec, $StatusEzentis, $Observacoes, $Sinalizacao, $UsuarioModificador, $DataModificacao, $Usuario_idUsuario, $id) {
//
//    $resmes = $this->db->query("UPDATE `preventiva` SET DataExec='$DataExec', `StatusEzentis`= '$StatusEzentis', `Observacoes`='$Observacoes', "
//        . "`Sinalizacao`='$Sinalizacao', `UsuarioModificador`= '$UsuarioModificador', `DataModificacao`='$DataModificacao', `Usuario_idUsuario`='$Usuario_idUsuario' WHERE id=$id");
//    return $resmes;
//}
//
//public function set_Preventiva_nova($idPreventiva, $Alvo, $MesProg, $Sinalizacao, $UsuarioModificador, $DataModificacao, $Estacoes_idEstacoes, $Usuario_idUsuario) {
//
//    $preventivaNova = $this->db->query("INSERT INTO preventiva(idPreventiva, Alvo, MesProg,Sinalizacao, UsuarioModificador, DataModificacao, "
//        . "Estacoes_idEstacoes, Usuario_idUsuario) VALUES ('$idPreventiva','$Alvo','$MesProg','$Sinalizacao','$UsuarioModificador',"
//        . "'$DataModificacao','$Estacoes_idEstacoes','$Usuario_idUsuario')");
//    return $preventivaNova;
//}
//
//public function validar_preventiva_mes($mes) {
//    $resmes = $this->db->query("SELECT COUNT(id)AS cont FROM `preventiva` WHERE MesProg ='$mes'");
//    return $resmes->row();
//}
//
//public function get_historico($condicao) {
//    $historico = $this->db->query("SELECT filtropreve.EnderecoId,DATE_FORMAT(auditprev.DataExec, '%d-%m-%Y') AS DataExec, auditprev.StatusEzentis, auditprev.Observacoes, auditprev.UsuarioModificador, "
//        . "filtropreve.NomeCm, filtropreve.NomeEstacao, filtropreve.MesProg, filtropreve.NomeUsuario, filtropreve.id, filtropreve.Alvo, filtropreve.NomeRegiao "
//        . "FROM `auditprev` INNER JOIN filtropreve ON "
//        . "auditprev.id = filtropreve.id WHERE $condicao");
//    return $historico;
//}
//
//public function get_rejeitadastecnico() {
//    $historico = $this->db->query("SELECT COUNT(1) as rejeitadas,NomeUsuario,NomeCm, StatusEzentis FROM "
//        . "`viewauditprev` WHERE MesProg='Mar/2019' and StatusEzentis ='Rejeitada' GROUP BY NomeUsuario "
//        . "ORDER BY `rejeitadas` DESC limit 5");
//    return $historico;
//}
//}
