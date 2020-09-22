<?php

defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('America/Sao_Paulo');
require FCPATH . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use \PhpOffice\PhpSpreadsheet\RichText\RichText;
use \PhpOffice\PhpSpreadsheet\Style\Color;

class Wo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) { // validar se usuario esta logado
            redirect('Login');
        }

        $this->load->helper('functions');
        $this->load->model((array('preventiva_model', 'comum_model', 'crud_model')));
        $this->load->library('PHPExcel');
    }

    public function Index() {
        if ($this->input->post('programacao')) {
            $mesprogramacao = $this->input->post('programacao');
        } else {
            $mesprogramacao = date('Y-m-01');
        }
        $data = array(
            "styles" => array(
                "css/dataTables.bootstrap.min.css",
                "css/datatables.min.css"
            ),
            "scripts" => array(
                "js/dataTables.bootstrap.min.js",
                "js/datatables.min.js",
                "js/util.js",
                "js/wo.js",
                "js/pace.min.js",
                "js/pages/pages-data.js",
                "js/pace.min.js",
            ),
        );

        $data['titulo'] = 'Lista de de wo\'s';
        $data['tituloSuperior'] = 'Ezentis - Lista de wo\'s';
        $this->load->view("layout/_head", $data);
        $this->load->view("wo/index");
        $this->load->view("layout/_scripts");
    }

    public function ajaxListeWo() {
        if (!$this->input->is_ajax_request()) {
            exit("Nenhum acesso de script direto permitido!");
        }
        $mes = '';

        $this->load->model("woDatatable_model");
        $wos = $this->woDatatable_model->get_datatableWo();

        $data = array();

        foreach ($wos as $wo) {
            $site = explode(" ", $wo->nomeestacao);
            $site = explode("-", $wo->nomeestacao);
            $row = array(); // cada linha da lista preventivas
            $row[] = $wo->situacao;
            $row[] = $wo->wo;
            $row[] = $site[0];
            $row[] = $wo->status;
            $row[] = $wo->nomecm;
            $row[] = $wo->detalhamento;
            $row[] = $wo->responsavelTim;

            $adm_lid_back = array('admin', 'lider', 'backoffice');
            if ($this->ion_auth->in_group($adm_lid_back)) {

                $row[] = '<div style="display: inline-block;">
        <a href="' . base_url('wo/editar?id=' . $wo->idwo) . ' "class="editar btn btn-primary">
            <i class="fa fa-edit"></i></a>
        <button class="btn btn-danger btn-del-preventiva" 
        idPreventiva="' . $wo->idwo . '">
        <i class="fa fa-times"></i>
        </button>
        </div>';
            }
            $data[] = $row;
        }

        $json = array(
            "draw" => $this->input->post("draw"),
            "recordsTotal" => $this->woDatatable_model->records_total(),
            "recordsFiltered" => $this->woDatatable_model->records_filtered(),
            "data" => $data,
        );

        echo json_encode($json);
    }

    public function gerarRelatorio() {

        $data = array(
            "scripts" => array(
                "sweetalert2.all.min.js",
                "js/util.js",
                "js/preventiva.js"
            ),
            'titulo' => 'Baixar relatório de WO\'s',
            'tituloSuperior' => 'Ezentis - Baixar relatório de WO\'s',
        );
//        $data['mes'] = functionHtmlOptions('', $this->crud_model->selectDistinct('mesprogramacao', 'filtropreventivas', 'mesprogramacao !=""'), 'mesprogramacao', 'mesprogramacao');
        $data['options_regiao'] = functionHtmlOptions('', $this->crud_model->selectDistinct('nomeregiao,regiao_idregiao', 'filtropreventivas', 'nomeregiao !=""'), 'regiao_idregiao', 'nomeregiao');
        $this->load->view("layout/_head", $data);
        $this->load->view("wo/relatorioWo");
        $this->load->view("layout/_scripts");
    }

    public function baixarRelatorio() {
        $data = elements(
                array(
                    'idregiao'
                ), $this->input->post()
        );
        $data = html_escape($data); //limpar possiveis codigos maliciosos do input
        $data = array_filter($data);
        $data = functionStringCondicaoAnd($data);

        $filtroSql = $this->Core_model->get_all('filtrowo', $data);
        $fimarray = count($filtroSql) + 2;
        $cont = 3;
        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load("templeiteWo.xlsx");
        $sheet = $spreadsheet->getActiveSheet();
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                ],
            ],
        ];

        $sheet->getStyle('A3:S' . $fimarray)->applyFromArray($styleArray);
        foreach ($filtroSql as $row) {
            $sheet->setCellValue('A' . $cont, $row->situacao);
            $sheet->setCellValue('B' . $cont, $row->wo);
            $sheet->setCellValue('C' . $cont, $row->status);
            $sheet->setCellValue('D' . $cont, $row->dataatribuicao);
            $sheet->setCellValue('E' . $cont, $row->nomeestacao);
            $sheet->setCellValue('F' . $cont, $row->nomeregiao);
            $sheet->setCellValue('G' . $cont, $row->nomecm);
            $sheet->setCellValue('H' . $cont, $row->cidade);
            $sheet->setCellValue('I' . $cont, $row->detalhamento);
            $sheet->setCellValue('J' . $cont, $row->ate);
            $sheet->setCellValue('K' . $cont, $row->responsavelTim);
            $sheet->setCellValue('L' . $cont, $row->nometecnico);
            $sheet->setCellValue('M' . $cont, $row->datafechamento);
            $sheet->setCellValue('N' . $cont, $row->horasdeslocamento);
            $sheet->setCellValue('O' . $cont, $row->horastrabalhadas);
            $sheet->setCellValue('P' . $cont, $row->horatotal);
            $sheet->setCellValue('Q' . $cont, $row->fechamento);
            $sheet->setCellValue('R' . $cont, $row->quantidadetecnicos);
            $sheet->setCellValue('S' . $cont, $row->observacoes);
            $cont++;
        }

        $objWriter = IOFactory::createWriter($spreadsheet, 'Xlsx');
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Relatoiro_WOs_SOG.xlsx"');
        header("Content-Transfer-Encoding: binary ");
        header('Content-Disposition: attachment;filename="Relatoiro_WOs_SOG.xlsx"');
        header('Cache-Control: max-age=0');
        ob_end_clean();
        $objWriter->save('php://output');
    }

    public function cargaMassivaProgramacao() {
        $adm_lid = array('admin', 'lider');
        if ($this->ion_auth->in_group($adm_lid)) {
            $this->form_validation->set_rules('data', 'Data', 'required');
            if ($this->form_validation->run()) {
                try {
                    $excelobject = \PhpOffice\PhpSpreadsheet\IOFactory::identify($_FILES['file']['tmp_name']);
                    $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($excelobject);
                    $spredsheet = $reader->load($_FILES['file']['tmp_name']);
                    $data = $spredsheet->getActiveSheet()->toArray();
                    $ultimaLinha = count($data);
                } catch (Exception $e) {
                    $this->session->set_flashdata('error', 'Erro na leitura do arquivo');
                    redirect('preventiva/cargaMassivaProgramacao');
                }

                $dataForm = str_replace('/', '-', $this->input->post("data"));
                $dataForm = date("Y-m-01", strtotime($dataForm)); //data do formulario
//                $preventivasCadastradas = $this->crud_model->selectLinha('count(idpreventiva) AS count', 'preventiva', array('mesprogramacao' => $dataForm));
                $cadastrarPreventiva = array();
                $preventivasCarregar = array();
                $preventivasNaoCarregar = array();
                $carregarPrev = array();
                $naoCarregarPrev = array();
                foreach ($data as $row => $value) {
                    if ($value[21] == 'Data Programação') { // validar o arquivo
                        break;
                    } else {
                        $this->session->set_flashdata('error', 'Erro na leitura do arquivo');
                        redirect('preventiva/cargaMassivaProgramacao');
                    }
                }

                foreach ($data as $row => $value) {
                    if ($row > 0) {
//                    $atualizaPrevenvida = array();
//                        echo "<prev>";
//                        print_r($data);
//                        exit();
                        $time = $value[21]; //mes de programação

                        $data = explode("/", $time);

// Cria três variáveis $dia $mes $ano
                        list($dia, $mes, $ano) = $data;
                        $dataExcel = "$ano-$mes-01";

                        $prevCadastrada = $this->crud_model->selectLinha('count(idpreventiva) AS count', 'preventiva', array('mesprogramacao' => $dataForm, 'sgmp' => $value[0]));
                        $usuarioLogado = $this->ion_auth->users()->row();
//                                                echo "<prev>";
//                                                echo  $value[0].' - dataExcel'.($dataExcel)."----  dataForm".$dataForm;
//                                                exit();
//                                                echo '$prevCadastrada'.($prevCadastrada->count)."<br>";
//                       exit();
                        if ($prevCadastrada->count == 0 and $value[6] == 'TSL' and $dataExcel == $dataForm) {
//                          $Estacoes_idEstacoes = $this->crud_model->selectLinha('idestacao', 'estacao', "endid='" . $value[4] . "'");
                            if ($this->crud_model->selectLinha('idestacao', 'estacao', "endid='" . $value[4] . "'")) {
                                $Estacoes_idEstacoes = $this->crud_model->selectLinha('idestacao', 'estacao', "endid='" . $value[4] . "'");
                                $carregarPrev = ["sgmp" => $value[0], "acompanhamento" => 7, 'usersid' => 1, "alvo" => $value[1], "status" => 1, "estacao_idestacao" => $Estacoes_idEstacoes->idestacao, "origemdemanda" => $value[12], "mesprogramacao" => $dataExcel, 'usuariomod' => $usuarioLogado->first_name, 'datamod' => date("Y-m-d H:i:s"), 'contrato' => $value[10], 'observacoes' => 'Carregamento automático'];
//                            array_push($preventivasCarregar, $carregarPrev);
                                $usuarioLogado = $this->ion_auth->users()->row();
//                                                echo "<prev>";
//                                                echo '$carregarPrev'.($carregarPrev)."<br>";

                                $this->Core_model->insert('preventiva', $carregarPrev);
                            } else {
                                $naoCarregarPrev = ["sgmp" => $value[0], "estacao_idestacao" => $value[4], "erro" => "endId não encontrado", "mesprogramacao" => $dataExcel, 'contrato' => $value[10]];
                                array_push($preventivasNaoCarregar, $naoCarregarPrev);
                            }
                        }

//                        $this->Core_model->update('preventiva', $atualizaPrevenvida, array('mesprogramacao' => $dataForm, 'sgmp' => $value[0]));
                    }
                }
                if ($preventivasNaoCarregar) {
                    $this->session->set_flashdata('errorPreventiva', 'Não foi possivel carregar todos as preventivas');
                } else {
                    $this->session->set_flashdata('sucesso', 'Registro atualizados com sucesso');
                    redirect('preventiva');
                }
            }


            $data = array(
                "styles" => array(),
                "scripts" => array(
                    "js/pace.min.js",
                ),
            );

            $data['mesSelect'] = functionSelectMes();
            if (isset($preventivasNaoCarregar)) {
                $data['preventivasNaoCarregar'] = $preventivasNaoCarregar;
            }
            $data['titulo'] = 'Cadastro de preventivas';
            $data['tituloSuperior'] = 'Ezentis - Cadastro de preventivas';
            $this->load->view("layout/_head", $data);
            $this->load->view("preventiva/cargaMassivaProgramacao");
            $this->load->view("layout/_scripts");
        } else {
            $this->session->set_flashdata('error', 'Você não tem permisão acessar esta página!!');
            redirect('preventiva');
        }
    }

    public function acompanhamento() {
        $adm_lid_back = array('admin', 'lider', 'backoffice', 'coordenador');
        if ($this->ion_auth->in_group($adm_lid_back)) {
            $this->form_validation->set_rules('mesprogramacao', 'mesprogramacao', 'required');
            if ($this->form_validation->run()) {

                $data = elements(
                        $array = array(
                    'mesprogramacao',
                    'contrato'
                        ), $this->input->post()
                );
                $data = html_escape($data); //limpar possiveis codigos maliciosos do input
                $parametro = functionStringCondicaoAnd($data);
                $filtro = $this->input->post('contrato');
                $mes = $this->input->post('mesprogramacao');
            } else {
                $array = array(
                    'mesprogramacao' => date('M/Y'),
                    'contrato' => 'FMMT_Franquia'
                );
                $parametro = functionStringCondicaoAnd($array);
                $filtro = 'FMMT_Franquia';
            }
//       $acompanhamento = $this->preventiva_model->get_acompanhamento_all($parametro); 
//                       echo '<pre>';
//           print_r($parametro);
//           exit();
            if (!isset($mes)) {
                $data['mes'] = date('M/Y');
            } else {
                $data['mes'] = $this->input->post('mesprogramacao');
            }
//       
//      echo '<pre>';
//           print_r( $data['mes']);
//           exit();


            $mesBd = $this->crud_model->selectDistinct('mesprogramacao', 'filtropreventivas', array('nomeregiao != ""'));
            $data['mesSelect'] = functionHtmlOptions('', $mesBd, 'mesprogramacao', 'mesprogramacao');

            $contratoBd = $this->crud_model->selectDistinct('contrato', 'filtropreventivas', 'contrato !=""');
            $data['contrato'] = functionHtmlOptions('', $contratoBd, 'contrato', 'contrato');
            $data['acompanhamento'] = $this->preventiva_model->get_acompanhamento_all($parametro);
            $data['titulo'] = 'Acompanhamento de preventivas';
            $data['filtro'] = $filtro;
            $data['tituloSuperior'] = 'Ezentis - Acompanhamento de preventivas';
            $this->load->view("layout/_head", $data);
            $this->load->view("preventiva/acompanhamento");
            $this->load->view("layout/_scripts");
        } else {
            $this->session->set_flashdata('error', 'Você não tem permisão acessar esta página!!');
            redirect('preventiva');
        }
    }

    public function editar() {
        $adm_lid_back = array('admin', 'lider', 'backoffice');
        if ($this->ion_auth->in_group($adm_lid_back)) {
            $this->form_validation->set_rules('dataexecucao', 'Data Execução', 'required');
            if ($this->form_validation->run()) {
                $data = elements(
                        $array = array(
                    'dataexecucao',
                    'acompanhamento',
                    'usersid',
                    'observacoes'
                        ), $this->input->post()
                );
                if ($this->input->post('observacoes') == 'Carregamento automático') {
                    unset($data['observacoes']);
                }
                $destinatario = $this->ion_auth->user($this->input->post('usersid'))->row();
                $acompanhamento = $this->Core_model->get_all('acompanhamentopreventiva', array('idacompanhamento' => $this->input->post('acompanhamento')));
                $endid = $this->input->post('endid');
                $user = $this->ion_auth->user()->row();
                $data['usuariomod'] = $user->first_name;
//            echo '<pre>';
//            print_r($this->input->post('endid'));
//            exit();
                $data = html_escape($data); //limpar possiveis codigos maliciosos do input
                $condicao['idpreventiva'] = html_escape($this->input->post('idpreventiva'));

                if ($this->Core_model->update('preventiva', $data, $condicao)) {
                    $this->session->set_flashdata('sucesso', 'Dados atualizados com sucesso');
                    email('Acompanhamento da preventiva (' . $endid . ')', $destinatario->email, 'Status da Preventivas -> ' . $endid, $acompanhamento[0]->nomeacompanhamento, $this->input->post('observacoes'));
                    redirect('preventiva');
                } else {
                    $this->session->set_flashdata('error', 'Erro ao atualizadosos dados da preventiva');
                }
            }
            $idWo = $this->input->get('id');
            $data['wo'] = $this->Core_model->get_by_id('filtrowo', array('idwo' => $idWo));
            $data['status'] = $this->Core_model->get_all('acompanhamentopreventiva', array('idacompanhamento != ' => 2, 'idacompanhamento !=' => 4));
//        echo '<pre>';
//        print_r($data['wo']);
//        exit();
            $data['tecnico'] = $this->Core_model->get_all('users', array());
            $data['titulo'] = 'Editar Editar wo\'s';
            $data['tituloSuperior'] = 'Ezentis - Editar wo\'s';
            $this->load->view("layout/_head", $data);
            $this->load->view("wo/edit");
            $this->load->view("layout/_scripts");
        } else {
            $this->session->set_flashdata('error', 'Você não tem permisão acessar esta página!!');
            redirect('preventiva');
        }
    }

    public function delet() {
        if ($this->ion_auth->in_group(array('admin', 'lider'))) {
            $obj = ($this->input->post('observacoes'));

            if ($obj[0] != "") {
                $user = $this->ion_auth->user()->row();
                $data['usuariomod'] = $user->first_name;
                $data['observacoes'] = $obj[0];
                $data['status'] = 0;
                $this->Core_model->update('preventiva', $data, array("idPreventiva" => $this->input->post('idPreventiva')));
                $this->Core_model->delete('preventiva', array("idPreventiva" => $this->input->post('idPreventiva')));
            } else {
                $this->session->set_flashdata('error', 'Você precisa inserir todas as informações solicitadas, refaça o processo, Caso o problema persista, contate o administrador');
            }



//        } else {
            //  $this->session->set_flashdata('error', 'Você não tem permissão para esta ação!!!!!');
//        }
        }
        $this->session->set_flashdata('error', 'Você não tem permissão para esta ação!!!!!');
        redirect('preventiva');
    }

}
