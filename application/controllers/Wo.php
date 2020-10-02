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

    public function editar() {
        $adm_lid_back = array('admin', 'lider', 'backoffice');
        if ($this->ion_auth->in_group($adm_lid_back)) {
            $this->form_validation->set_rules('status', 'Status', 'required');
            if ($this->form_validation->run()) {
                $data = elements(
                        $array = array(
                    'status',
                    'datafechamento',
                    'horasdeslocamento',
                    'quantidadetecnicos',
                    'tecnico',
                    'fechamento',
                        ), $this->input->post()
                );
//                            echo '<pre>';
//            print_r($this->input->post());
//            exit();
//                $destinatario = $this->ion_auth->user($this->input->post('usersid'))->row();
//                $acompanhamento = $this->Core_model->get_all('acompanhamentopreventiva', array('idacompanhamento' => $this->input->post('acompanhamento')));
                $endid = $this->input->post('endid');
                $user = $this->ion_auth->user()->row();
                $data['usuariomodificar'] = $user->first_name;
//            echo '<pre>';
//            print_r($this->input->post('endid'));
//            exit();
                $data = html_escape($data); //limpar possiveis codigos maliciosos do input
                $condicao['idwo'] = html_escape($this->input->post('idwo'));

                if ($this->Core_model->update('wo', $data, $condicao)) {
                    $this->session->set_flashdata('sucesso', 'Dados atualizados com sucesso');
//                    email('Acompanhamento da preventiva (' . $endid . ')', $destinatario->email, 'Status da Preventivas -> ' . $endid, $acompanhamento[0]->nomeacompanhamento, $this->input->post('observacoes'));
                    redirect('wo');
                } else {
                    $this->session->set_flashdata('error', 'Erro ao atualizadosos dados da Wo');
                }
            }
            $idWo = $this->input->get('id');
            $historico = $this->input->get('h');

            if (!is_numeric($idWo)) {
                $this->session->set_flashdata('error', ' Dados não encontrado');
                redirect('wo');
            } else {
                if ($historico == '1548a$3a') {
                    $data['wo'] = $this->Core_model->get_by_id('filtrowofechada', array('idwo' => $idWo));
                } else {
                    $data['wo'] = $this->Core_model->get_by_id('filtrowo', array('idwo' => $idWo));
                }

                if (!isset($data['wo'])) {
                    $this->session->set_flashdata('error', 'Não foi possível realizar a consulta');
                    redirect('wo');
                }

                $data['status'] = $this->Core_model->get_all('acompanhamentopreventiva', array('idacompanhamento != ' => 2, 'idacompanhamento !=' => 4));
//        echo '<pre>';
//        print_r($data['wo']);
//        exit();
                $data['tecnico'] = $this->Core_model->get_all('users', array());
                $data['titulo'] = 'Editar wo\'s';
                $data['tituloSuperior'] = 'Ezentis - Editar wo\'s';
                $this->load->view("layout/_head", $data);
                $this->load->view("wo/edit");
                $this->load->view("layout/_scripts");
            }
        } else {
            $this->session->set_flashdata('error', 'Você não tem permisão acessar esta página!!');
            redirect('preventiva');
        }
    }

    public function historicoWo() {
        $adm_lid_back = array('admin', 'lider', 'backoffice');
        if ($this->ion_auth->in_group($adm_lid_back)) {
            $wo = array();
            $this->form_validation->set_rules('valid', 'valid', 'required');
            if ($this->form_validation->run()) {
                $dados = elements(
                        $array = array(
                    'wo',
                    'endid',
                        ), $this->input->post()
                );
                $dados = array_filter($dados);


                if (html_escape($this->input->post('wo')) == '' AND html_escape($this->input->post('endid')) == '') {
                    $this->session->set_flashdata('error', 'Você precisa informar a WO ou End Id para consulta');
                    unset($wo);
                    redirect('historicowos');
                } else {
                    $this->session->set_flashdata('error', '');
                    $wo = $this->Core_model->get_all('filtrowofechada', $dados);

                    if (empty($wo)) {
                        $wo = $this->Core_model->get_all('filtrowo', $dados);
                        if (empty($wo)) {
                            $this->session->set_flashdata('error', 'Não encontranos nem uma informação');
                            unset($wo);
                            redirect('historicowos');
                        }
                    }
                }
            }
            $data = array(
                "styles" => array(
                    "css/dataTables.bootstrap.min.css",
                ),
                "scripts" => array(
                    "js/dataTables.bootstrap.min.js",
                    "js/datatables.min.js",
                ),
            );
//                                    echo '<pre>';
//        print_r($wo);
//        exit();
//            if(!isset($wo)){
            $data['wo'] = $wo;
//            }

            $data['titulo'] = 'Historico  wo\'s';
            $data['tituloSuperior'] = 'Ezentis - Historico wo\'s';
            $this->load->view("layout/_head", $data);
            $this->load->view("wo/historico");
            $this->load->view("layout/_scripts");
        } else {
            $this->session->set_flashdata('error', 'Você não tem permisão acessar esta página!!');
            redirect('preventiva');
        }
    }

    public function resultadoHistoricoWo() {
        $adm_lid_back = array('admin', 'lider', 'backoffice');
        if ($this->ion_auth->in_group($adm_lid_back)) {
            $data['titulo'] = 'Historico  wo\'s';
            $data['tituloSuperior'] = 'Ezentis - Historico wo\'s';
            $this->load->view("layout/_head", $data);
            $this->load->view("wo/historico");
            $this->load->view("layout/_scripts");
        } else {
            $this->session->set_flashdata('error', 'Você não tem permisão acessar esta página!!');
            redirect('preventiva');
        }
    }

}
