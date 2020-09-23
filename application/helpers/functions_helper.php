<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//&get_instance();


function functionFormatData($data) {
    if (isset($data)) {
        $explode = explode('-', $data);
        if (strlen($explode[0]) == 4) {
            $dataEditada = $explode[0] . '-' . $explode[1] . '-' . '01';
        } else {
            $dataEditada = $explode[2] . '-' . $explode[1] . '-' . '01';
        }
        return $dataEditada;
    }
}

function functionVerificaEndId($array) {
    $Ci = &get_instance();
    $itens = array();
    foreach ($array as $value) {
        $end = $value['estacao'];
        $endId = $Ci->crud_model->selectLinha('COUNT(endid) as cont', 'estacao', "endid='" . $end . "'");
        if ($endId->cont == 0) {
            $arrpush = ["estacao" => $value['estacao']];
            array_push($itens, $arrpush);
        }
    }
    return $itens;
}

function email($assunto, $destinatario,$copiaEmail, $tituloPrincipal, $titulo, $mensagem) {
    $Ci = &get_instance();
    $Ci->load->library('email');


    $Ci->email->from("backoffice.tsl.pinhais@gmail.com", 'BackOffice');
    $Ci->email->subject($assunto);
    $Ci->email->reply_to("");
    $Ci->email->to($destinatario);
    $Ci->email->cc($copiaEmail);
    $Ci->email->bcc('');
    $Ci->email->message('
        <style>
        .box {
  background:#fff;
  transition:all 0.2s ease;
  border:2px dashed #dadada;
  margin-top: 10px;
  box-sizing: border-box;
  border-radius: 5px;
  background-clip: padding-box;
  padding:0 20px 20px 20px;
  min-height:340px;
}

.box:hover {
  border:2px solid #FF4500;
}


.box .box-content {
  padding: 16px;
  border-radius: 0 0 2px 2px;
  background-clip: padding-box;
  box-sizing: border-box;
}
.box .box-content p {
  color:#FF4500;
  text-transform:none;
}
</style>

<div class="container">
	<div class="row">
		<h1 class="text-center">'.$tituloPrincipal.'</h1>
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="box">
                        <div class="box-content">
                            <h2 class="tag-title">'.$titulo.'</h2>
                            <hr />
                            <h3><p>'.$mensagem.'</p></h3>
                            <br />                           
                        </div>
                     <h3><p>*Este é um e-mail automático, favor não responda ...</p></h3>                    
                    </div>
                </div>               
            </div>           
        </div>
	</div>
</div>     


  ');
    $Ci->email->send();

    echo $Ci->email->print_debugger();
}

function functionStringCondicaoAnd($array) {
    $cont = 0;
    foreach ($array as $chave => $valor) {
        if ($valor == "") {
            
        } else {
            $cont = $cont + 1;
            $stringArrayF[$cont] = $chave . " = '" . $valor . "'";
        }
    }
    return $stringArray = implode(" AND ", $stringArrayF);
}

function functionInputMes($input) {
    date_default_timezone_set('America/Sao_Paulo');
    $mesSelect = $input;
    if (empty($mesSelect)) {
        $mesSelect = $mesAtual = date('M/Y');
    }
    return $mesSelect;
}

function functionHtmlOptions($option, $resultSql, $value, $echo) {
    $options = "<option value=" . $option . ">{$option}</optin>";
    foreach ($resultSql as $valor) {
        $options .= "<option value='{$valor->$value}'>{$valor->$echo}</option>";
    }
    return $options;
}

function functionGerarRelatorioPreventiva($array) {
    $Ci = &get_instance();
    $planilha = $Ci->phpexcel; //inst. o phpexecl
    $planilha->setActiveSheetIndex(0)->setCellValue('A2', 'ID DGMP'); // campo da celua A1
    $planilha->setActiveSheetIndex(0)->setCellValue('B2', 'END ID'); // campo da celua A1
    $planilha->setActiveSheetIndex(0)->setCellValue('C2', 'ORIGEM'); // campo da celua A1
    $planilha->setActiveSheetIndex(0)->setCellValue('D2', 'Contrato'); // campo da celua A1
    $planilha->setActiveSheetIndex(0)->setCellValue('E2', 'SITE'); // campo da celua A1
    $planilha->setActiveSheetIndex(0)->setCellValue('F2', 'REGIAO'); // campo da celua A1
    $planilha->setActiveSheetIndex(0)->setCellValue('G2', 'CM'); // campo da celua A1
    $planilha->setActiveSheetIndex(0)->setCellValue('H2', 'ALVO'); // campo da celua A1
    $planilha->setActiveSheetIndex(0)->setCellValue('I2', 'MES PROG'); // campo da celua A1
    $planilha->setActiveSheetIndex(0)->setCellValue('J2', 'STATUS'); // campo da celua A1
    $planilha->setActiveSheetIndex(0)->setCellValue('K2', 'TECNICO'); // campo da celua A1
    $planilha->setActiveSheetIndex(0)->setCellValue('L2', 'OBSERVAÇÕES'); // campo da celua A1
    $contador = 2;

    foreach ($array->result() as $row) {
        $contador++;
        $planilha->setActiveSheetIndex(0)->setCellValue('A' . $contador, $row->sgmp);
        $planilha->setActiveSheetIndex(0)->setCellValue('B' . $contador, $row->endid);
        $planilha->setActiveSheetIndex(0)->setCellValue('C' . $contador, $row->origemdemanda);
        $planilha->setActiveSheetIndex(0)->setCellValue('D' . $contador, $row->contrato);
        $planilha->setActiveSheetIndex(0)->setCellValue('E' . $contador, $row->nomeestacao);
        $planilha->setActiveSheetIndex(0)->setCellValue('F' . $contador, $row->nomeregiao);
        $planilha->setActiveSheetIndex(0)->setCellValue('G' . $contador, $row->nomecm);
        $planilha->setActiveSheetIndex(0)->setCellValue('H' . $contador, $row->alvo);
        $planilha->setActiveSheetIndex(0)->setCellValue('I' . $contador, $row->mesprogramacao);
        $planilha->setActiveSheetIndex(0)->setCellValue('J' . $contador, $row->statuscontratada);
        $planilha->setActiveSheetIndex(0)->setCellValue('K' . $contador, $row->nomeusuario);
        $planilha->setActiveSheetIndex(0)->setCellValue('L' . $contador, $row->observacoes);
    }

// $planilha->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment :: HORIZONTAL_CENTER);
    // $planilha->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill :: FILL_SOLID);
    // $planilha->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('FFFF0000');
    $planilha->getActiveSheet()->getColumnDimension('A')->setAutosize(true);
    $planilha->getActiveSheet()->getColumnDimension('B')->setAutosize(true);
    $planilha->getActiveSheet()->getColumnDimension('C')->setAutosize(true);
    $planilha->getActiveSheet()->getColumnDimension('D')->setAutosize(true);
    $planilha->getActiveSheet()->getColumnDimension('E')->setAutosize(true);
    $planilha->getActiveSheet()->getColumnDimension('F')->setAutosize(true);
    $planilha->getActiveSheet()->getColumnDimension('G')->setAutosize(true);
    $planilha->getActiveSheet()->getColumnDimension('H')->setAutosize(true);
    $planilha->getActiveSheet()->getColumnDimension('I')->setAutosize(true);
    $planilha->getActiveSheet()->getColumnDimension('J')->setAutosize(true);
    $planilha->getActiveSheet()->getColumnDimension('K')->setAutosize(true);
    $planilha->getActiveSheet()->getColumnDimension('L')->setAutosize(false);

//Centralizar a celula
    $planilha->getActiveSheet()->getStyle("A2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $planilha->getActiveSheet()->getStyle("B2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $planilha->getActiveSheet()->getStyle("C2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $planilha->getActiveSheet()->getStyle("D2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $planilha->getActiveSheet()->getStyle("E2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $planilha->getActiveSheet()->getStyle("F2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $planilha->getActiveSheet()->getStyle("G2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $planilha->getActiveSheet()->getStyle("H2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $planilha->getActiveSheet()->getStyle("I2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $planilha->getActiveSheet()->getStyle("J2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $planilha->getActiveSheet()->getStyle("K2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $planilha->getActiveSheet()->getStyle("L2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $planilha->getActiveSheet()->getColumnDimension('K')->setWidth('10');

    $planilha->getActiveSheet()->setShowGridlines(TRUE); //linhas da planilha
    $planilha->getActiveSheet()->setTitle('Preventivas'); //nome da planilha

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Relatoiro_SOG.xlsx"');
    header('Cache-Control: max-age=0');

    $objGravar = PHPExcel_IOFactory::createWriter($planilha, 'Excel2007'); // tipo do arquivo
    $objGravar->save('php://output'); //salvar
}

function functionPostUsuario($status) {
    $Ci = &get_instance();
    $usuario = array(
        'matricula' => $Ci->input->post('matricula'),
        'nomeusuario' => $Ci->input->post('nomeusuario'),
        'telefone1' => $Ci->input->post('telefone1'),
        'telefone2' => $Ci->input->post('telefone2'),
        'email1' => $Ci->input->post('email1'),
        'email2' => $Ci->input->post('email2'),
        'cpf' => $Ci->input->post('cpf'),
        'endereco' => $Ci->input->post('endereco'),
        'complemento' => $Ci->input->post('complemento'),
        'bairro' => $Ci->input->post('bairro'),
        'cidade' => $Ci->input->post('cidade'),
        'usuariomod' => $Ci->session->userdata("user_id"),
        'datamod' => date('Y-m-d H:i:s'),
        'nivelacesso_idnivelacesso' => $Ci->input->post('nivelacesso_idnivelacesso'),
        'cm_idcm' => $Ci->input->post('cm_idcm')
    );
    if ($status == 'insert') {
        $usuario['nivelacesso_idnivelacesso'] = $Ci->input->post('nivelacesso_idnivelacesso');
        $usuario['statusUsuario'] = 1;
    }


    return $usuario;
}

function functionSelectCm() {
    $Ci = &get_instance();
    $cm = functionHtmlOptions("", $Ci->crud_model->select("nomecm,idcm", "cm", "status =1"), "idcm", "nomecm");
    return $cm;
}

function functionSelectUser() {
    $Ci = &get_instance();
    $cm = functionHtmlOptions("", $Ci->crud_model->select("nomeusuario,idusuario", "usuario", "statusUsuario = 1 and nivelacesso_idnivelacesso != 1"), "idusuario", "nomeusuario");
    return $cm;
}

function functionSelectMes() {
    $Ci = &get_instance();
    $cm = functionHtmlOptions('', $Ci->crud_model->selectDistinct("mesprogramacao", "filtropreventivas", "mesprogramacao != ''"), "mesprogramacao", "mesprogramacao");
    return $cm;
}

function functionSelectCategoriaPendencia() {
    $Ci = &get_instance();
    $cm = functionHtmlOptions("", $Ci->crud_model->select("idcategoriapendencia,nomecategoria", "categoriapendencia", "idcategoriapendencia != 1"), "idcategoriapendencia", "nomecategoria");
    return $cm;
}

// function functionSelectData($data) {
//     date_default_timezone_set('America/Sao_Paulo');
//     $mesSelect = $data;
//     if (empty($mesSelect)) {
//         $mesSelect = date('M/Y');
//     }
//     return $mesSelect;
// }
// $Ci = &get_instance();
// $cm = functionHtmlOptions("", $Ci->crud_model->select("idcategoriapendencia,nomecategoria", "categoriapendencia", "idcategoriapendencia != 1"), "idcategoriapendencia", "nomecategoria");
// return $cm;
// }



function functionNameLogin($name, $matricula) {
    $Ci = &get_instance();
    $nome = $name;
    $temporario = explode(" ", $name);
    $temp = functionAcentos($temporario);
    $login = strtolower($temp[0] . "." . $temp[count($temp) - 1]);
    if ($Ci->crud_model->isDuplicated("usuario", "login", $login, "")) {

        $login = strtolower($temp[0] . "." . $temp[count($temp) - 2]);
    }
    if ($Ci->crud_model->isDuplicated("usuario", "login", $login, "")) {
        return $login = $matricula;
    } else {
        return $login;
    }
}

function functionAcentos($string) {
    return preg_replace(array("/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/", "/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/"), explode(" ", "a A e E i I o O u U n N"), $string);
}
