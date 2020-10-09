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

class Preventiva extends CI_Controller {

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
                "js/preventiva.js",
                "js/pace.min.js",
                "js/pages/pages-data.js",
                "js/pace.min.js",
            ),
        );

        $data['mesSelect'] = functionSelectMes();
        $data['atualizacao'] = $this->Core_model->ultimaatualizacao('data', 'atualizacaosistema', 'pagina = "preventiva"');

        $data['titulo'] = 'Lista de preventivas';
        $data['tituloSuperior'] = 'Ezentis - Lista de preventivas';
        $this->load->view("layout/_head", $data);
        $this->load->view("preventiva/index");
        $this->load->view("layout/_scripts");
    }

    public function ajaxListePreventiva() {
        if (!$this->input->is_ajax_request()) {
            exit("Nenhum acesso de script direto permitido!");
        }
        $mes = '';

        $this->load->model("preventivaDatatable_model");
        $preventivas = $this->preventivaDatatable_model->get_datatablePrev($mes);

//                   echo '<pre>';
//           print_r($preventivas);
//           exit();
        $data = array();

        foreach ($preventivas as $preventiva) {
            $site = explode(" ", $preventiva->nomeestacao);
            $site = explode("-", $preventiva->nomeestacao);
            $row = array(); // cada linha da lista preventivas
            $row[] = $preventiva->sgmp;
            $row[] = $preventiva->endid;
            $row[] = $site[0];
            $row[] = $preventiva->nomeregiao;
            $row[] = $preventiva->alvo;
            $row[] = $preventiva->mesprogramacao;
            $row[] = $preventiva->nomeacompanhamento;

            $adm_lid_back = array('admin', 'lider', 'backoffice');
            if ($this->ion_auth->in_group($adm_lid_back)) {

                $row[] = '<div style="display: inline-block;">
        <a href="' . base_url('preventiva/editar?id=' . $preventiva->idpreventiva) . ' "class="editar btn btn-primary">
            <i class="fa fa-edit"></i></a>
        <button class="btn btn-danger btn-del-preventiva" 
        idPreventiva="' . $preventiva->idpreventiva . '">
        <i class="fa fa-times"></i>
        </button>
        </div>';
            }
            $data[] = $row;
        }

        $json = array(
            "draw" => $this->input->post("draw"),
            "recordsTotal" => $this->preventivaDatatable_model->records_total(),
            "recordsFiltered" => $this->preventivaDatatable_model->records_filtered($mes),
            "data" => $data,
        );

        echo json_encode($json);
    }

    public function ajaxListePreventivaMes() {
        if (!$this->input->is_ajax_request()) {
            exit("Nenhum acesso de script direto permitido!");
        }
        $mes = $this->input->post("mes");
        $this->session->set_userdata("mes", $mes);

        $this->load->model("preventivaDatatable_model");
        $preventivas = $this->preventivaDatatable_model->get_datatablePrev();
        $data = array();

        foreach ($preventivas as $preventiva) {
            $site = explode(" ", $preventiva->nomeestacao);
            $row = array();
            $row[] = $preventiva->sgmp;
            $row[] = $preventiva->endid;
            $row[] = $site[0];
            $row[] = $preventiva->nomeregiao;
            $row[] = $preventiva->alvo;
            $row[] = $preventiva->mesprogramacao;
            $row[] = $preventiva->statuscontratada;

            $row[] = '<div style="display: inline-block;">
        <button class="btn btn-primary btn-edit-preventiva" 
        idPreventiva="' . $preventiva->idpreventiva . '">
        <i class="fa fa-edit"></i>
        </button>
        </div>';

            $data[] = $row;
        }

        $json = array(
            "draw" => $this->input->post("draw"),
            "recordsTotal" => $this->preventivaDatatable_model->records_total(),
            "recordsFiltered" => $this->preventivaDatatable_model->records_filtered(),
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
            'titulo' => 'Lista de preventivas',
            'tituloSuperior' => 'Ezentis - Lista de preventivas',
        );
        $data['mes'] = functionHtmlOptions('', $this->crud_model->selectDistinct('mesprogramacao', 'filtropreventivas', 'mesprogramacao !=""'), 'mesprogramacao', 'mesprogramacao');
        $data['options_regiao'] = functionHtmlOptions('', $this->crud_model->selectDistinct('nomeregiao,regiao_idregiao', 'filtropreventivas', 'nomeregiao !=""'), 'regiao_idregiao', 'nomeregiao');
        $this->load->view("layout/_head", $data);
        $this->load->view("preventiva/relatorioPreventiva");
        $this->load->view("layout/_scripts");
    }

    public function baixarRelatorio() {
        $data = elements(
                array(
                    'regiao_idregiao',
                    'nomecm',
                    'mesProgramacao',
                    'contrato'
                ), $this->input->post()
        );
        $data = html_escape($data); //limpar possiveis codigos maliciosos do input
        $data = array_filter($data);
        $contrato = $this->input->post('contrato');
        if ($contrato) {
            unset($data['contrato']); // caso não tenha sido passado nova senha, remove a senha do array
            $data['contrato !='] = 'FMMT_Zeladoria';
        }
//        print_r($data);
//        exit();
        $filtroSql = $this->Core_model->get_all('filtropreventivas', $data);
        $fimarray = count($filtroSql) + 2;
        $cont = 3;
        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load("templeite.xlsx");
        $sheet = $spreadsheet->getActiveSheet();
        $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                ],
            ],
        ];

        $sheet->getStyle('A3:M' . $fimarray)->applyFromArray($styleArray);
        foreach ($filtroSql as $row) {
            $sheet->setCellValue('A' . $cont, $row->sgmp);
            $sheet->setCellValue('B' . $cont, $row->endid);
            $sheet->setCellValue('C' . $cont, $row->cidade);
            $sheet->setCellValue('D' . $cont, $row->origemdemanda);
            $sheet->setCellValue('E' . $cont, $row->contrato);
            $sheet->setCellValue('F' . $cont, $row->nomeestacao);
            $sheet->setCellValue('G' . $cont, $row->nomeregiao);
            $sheet->setCellValue('H' . $cont, $row->nomecm);
            $sheet->setCellValue('I' . $cont, $row->alvo);
            $sheet->setCellValue('J' . $cont, $row->mesprogramacao);
            $sheet->setCellValue('K' . $cont, $row->nomeacompanhamento);
            $sheet->setCellValue('L' . $cont, $row->nomeusuario);
            $sheet->setCellValue('M' . $cont, $row->responsabilidade);
            $sheet->setCellValue('N' . $cont, $row->observacoes);
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
        header('Content-Disposition: attachment;filename="Relatoiro_SOG.xlsx"');
        header("Content-Transfer-Encoding: binary ");
        header('Content-Disposition: attachment;filename="Relatoiro_SOG.xlsx"');
        header('Cache-Control: max-age=0');
        ob_end_clean();
        $objWriter->save('php://output');
    }

    public function atualizarPreventivaStatus() {
        if ($this->ion_auth->in_group(array('admin', 'lider'))) {
             $copiaEmail = 'anderson.simoes@ezentis.com.br,jordana.alves@ezentis.com.br,silvana.santos@ezentis.com.br,bianca.belasquem@ezentis.com.br';
//            $copiaEmail = 'hallyson.batista@ezentis.com.br';

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
                    redirect('preventiva/atualizarPreventivaStatus');
                }

                $dataForm = str_replace('/', '-', $this->input->post("data"));
                $dataForm = date("Y-m-01", strtotime($dataForm)); //data do formulario
                $atualizaPrevenvida = array();
                foreach ($data as $row => $value) {
                    if ($value[21]) {
                        break;
                    } else {
                        $this->session->set_flashdata('error', 'Erro na leitura do arquivo');
                        redirect('preventiva/atualizarPreventivaStatus');
                    }
                }
                $update = 0; // atualizar data e hora da ultima atualizacao
                foreach ($data as $row => $value) {
                    if ($row > 0) {
                        $atualizaPrevenvida = array();
                        $time = $value[21];
                        $data = explode("/", $time);
// Cria três variáveis $dia $mes $ano
                        list($dia, $mes, $ano) = $data;
                        $data = "$ano-$mes-01";


                        if ($row > 0 and $data == $dataForm AND $this->preventiva_model->get_atualizacao_status_all(array('mesprogramacao' => $dataForm, 'sgmp' => $value[0]))) {
                            $preventivasBd = $this->preventiva_model->get_atualizacao_status_all(array('mesprogramacao' => $dataForm, 'sgmp' => $value[0]));
//                    echo $value[0] . " - " .  $value[12] . " - " .$preventivasBd->origemdemanda .  "<br>";   //apagar      //" BD - ".$preventivasBd->sgmp.".<br>";
//                COMPARAR COM O BD PARA IDENTIFICAR ALGUMA ALTERAÇÃO E ATUALIZAR A BASE
//SELECT `sgmp`, `alvo`, `origemdemanda`, `contrato`, `acompanhamento`, `mesprogramacao` FROM `preventiva` WHERE `mesprogramaca` = '2020-08-01' AND `sgmp` = 363876
                            if ($usuarioSgmp = $this->Core_model->get_all('users', array('matriculatim' => $value[16]))) {
                                if ($preventivasBd->usersid != $usuarioSgmp[0]->id) {
                                    $atualizaPrevenvida['usersid'] = $usuarioSgmp[0]->id;
                                    if ($preventivasBd->acompanhamento == 7) {
                                        $atualizaPrevenvida['acompanhamento'] = 10;
                                    }
                                }
                            }

                            if ($preventivasBd->origemdemanda != $value[12] or $value[10] != $preventivasBd->contrato) {

                                $atualizaPrevenvida['origemdemanda'] = $value[12];
                                $atualizaPrevenvida['contrato'] = $value[10];
//                        echo $r . " - " . $value[0] . "<- planilha ---- BD -> " . $preventivasBd->origemdemanda . "<br>";   //apagar      //" BD - ".$preventivasBd->sgmp.".<br>";
                            }
                            if ($value[25] == 'Aguardando Aprovação Contratada' and $preventivasBd->acompanhamento != 3) {
//                       atualiza status da preventiva (armazenar na array)
                                $atualizaPrevenvida['acompanhamento'] = 3; //analise
                            }
                            if ($value[25] == 'Aprovada' and $preventivasBd->acompanhamento == 1) {
//                       atualiza status da preventiva (armazenar na array)
                                $atualizaPrevenvida['acompanhamento'] = 2; //aprovada pela TIM
                            }
                            if ($value[25] == 'Rejeitada') {
//                       atualiza status da preventiva (armazenar na array)
                                $atualizaPrevenvida['acompanhamento'] = 4; // Rejeitada pela TIM
                                $atualizaPrevenvida['observacoes'] = $value[28]; // Rejeitada pela TIM
                            }
//                    Update
                            if ($atualizaPrevenvida) {
                                $usuarioLogado = $this->ion_auth->users()->row();
                                $atualizaPrevenvida['usuariomod'] = 'Automação';
                                $atualizaPrevenvida['datamod'] = date("Y-m-d H:i:s");
                                                
                                $prevFiltro = $this->Core_model->get_by_id('filtropreventivas', array('mesprogramacaooriginal' => $dataForm, 'sgmp' => $value[0]));
                                $update = 1;
                                $this->Core_model->update('preventiva', $atualizaPrevenvida, array('mesprogramacao' => $dataForm, 'sgmp' => $value[0]));
                               //pegar usuario da prevenva 
                                $usuarioDaPreentiva = $this->Core_model->get_by_id('preventiva', array('mesprogramacao' => $dataForm, 'sgmp' => $value[0]));
                              
                                if ($usuarioDaPreentiva->usersid != 3 and $value[25] == 'Rejeitada' and $prevFiltro->nomeacompanhamento != $value[25]) {

                                    $destinatario = $this->ion_auth->user($usuarioDaPreentiva->usersid)->row();

                                    $acompanhamento = $this->Core_model->get_all('acompanhamentopreventiva', array('idacompanhamento' => $atualizaPrevenvida['acompanhamento']));

                                    email('Status preventiva (' . $value[4] . ')', $destinatario->email, $copiaEmail, $value[1]." -> " . $acompanhamento[0]->nomeacompanhamento,"Preventiva: ". $value[4] . "  -   ID: (" . $value[0] .")", $value[28]);
                                   }
                                //end email
                            }

                            unset($atualizaPrevenvida);
                            $atualizaPrevenvida = array();
                        }
                    }
                }

                

                if ($update == 1) {
                    $this->Core_model->insert('atualizacaosistema', array('pagina' => 'preventiva', 'data' => date("Y-m-d H:i:s")));
                }
                $this->session->set_flashdata('sucesso', 'Registro atualizados com sucesso');
                redirect('preventiva');
            }


            $data = array(
                "styles" => array(),
                "scripts" => array(
                    "js/pace.min.js",
                ),
            );

            $data['mesSelect'] = functionSelectMes();
//        $data['resumo'] = "Lista de preventivas";
            $data['titulo'] = 'Atualizar preventivas';
            $data['tituloSuperior'] = 'Ezentis - Atualizar preventivas';
            $this->load->view("layout/_head", $data);
            $this->load->view("preventiva/atualizarStatusPreventiva");
            $this->load->view("layout/_scripts");
        } else {
            $this->session->set_flashdata('error', 'Você não tem permisão acessar esta página!!');
            redirect('preventiva');
        }
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
                                $carregarPrev = ["sgmp" => $value[0], "acompanhamento" => 7, 'usersid' => 3, "alvo" => $value[1], "status" => 1, "estacao_idestacao" => $Estacoes_idEstacoes->idestacao, "origemdemanda" => $value[12], "mesprogramacao" => $dataExcel, 'usuariomod' => 'Automação', 'datamod' => date("Y-m-d H:i:s"), 'contrato' => $value[10], 'observacoes' => 'Carregamento automático'];
//                            array_push($preventivasCarregar, $carregarPrev);
//                                $usuarioLogado = $this->ion_auth->users()->row();
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
                $contrato = $this->input->post('contrato');



                $data = elements(
                        $array = array(
                    'mesprogramacao',
                    'contrato'
                        ), $this->input->post()
                );

                $data = html_escape($data); //limpar possiveis codigos maliciosos do input
                $parametro = functionStringCondicaoAnd($data);
                if ($contrato == 'FMMT_Franquia' || $contrato == 'FMMT_Zeladoria' || $contrato == 'FMMT_Estrutura Vertical' || $contrato == 'FMMT_Franquia_LD') {
                    $parametro = $parametro . ' and origemdemanda != "Aceitação Física"';
                }
                $filtro = $this->input->post('contrato');
                $mes = $this->input->post('mesprogramacao');
            } else {
                $array = array(
                    'mesprogramacao' => date('M/Y'),
                    'contrato' => 'FMMT_Franquia',
                    'origemdemanda' => 'Cronograma'
                );
                $parametro = functionStringCondicaoAnd($array);

                if ($array['contrato'] == 'FMMT_Franquia' || $array['contrato'] == 'FMMT_Zeladoria' || $array['contrato'] == 'FMMT_Estrutura Vertical' || $array['contrato'] == 'FMMT_Franquia_LD') {
                    $parametro = $parametro . ' and origemdemanda !=" Aceitação Física"';
                }
                $filtro = 'FMMT_Franquia';
            }

            if (!isset($mes)) {
                $data['mes'] = date('M/Y');
            } else {
                $data['mes'] = $this->input->post('mesprogramacao');
            }

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
             $copiaEmail = 'anderson.simoes@ezentis.com.br,jordana.alves@ezentis.com.br,silvana.santos@ezentis.com.br,bianca.belasquem@ezentis.com.br';
//            $copiaEmail = 'hallyson.batista@ezentis.com.br';

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
//            print_r(html_escape($this->input->post('alvoPreventiva')));
//            exit();
                $data = html_escape($data); //limpar possiveis codigos maliciosos do input
                $condicao['idpreventiva'] = html_escape($this->input->post('idpreventiva'));

                if ($this->Core_model->update('preventiva', $data, $condicao)) {
                    $this->session->set_flashdata('sucesso', 'Dados atualizados com sucesso');
                    if (html_escape($this->input->post('acompanhamento')) == '4' || html_escape($this->input->post('acompanhamento')) == '5') {
                        email('Status preventiva (' . $endid . ')', $destinatario->email, $copiaEmail, html_escape($this->input->post('alvoPreventiva'))." -> " . $acompanhamento[0]->nomeacompanhamento, "Preventiva: ". $endid . "  -   ID: (" . html_escape($this->input->post('idpreventiva')).")", $this->input->post('observacoes'));
                       
                        
                    }

                    redirect('preventiva');
                } else {
                    $this->session->set_flashdata('error', 'Erro ao atualizadosos dados da preventiva');
                }
            }
            $idPreventiva = $this->input->get('id');
            $data['preventiva'] = $this->Core_model->get_by_id('filtropreventivas', array('idpreventiva' => $idPreventiva));
            $data['status'] = $this->Core_model->get_all('acompanhamentopreventiva', array('idacompanhamento != ' => 2));
//        echo '<pre>';
//        print_r($data['status']);
//        exit();
            $data['tecnico'] = $this->Core_model->get_all('users', array('active !=' => 0));
            $data['titulo'] = 'Editar preventivas';
            $data['tituloSuperior'] = 'Ezentis - Editar preventivas';
            $this->load->view("layout/_head", $data);
            $this->load->view("preventiva/edit");
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
        } else {
            $this->session->set_flashdata('error', 'Você não tem permissão para esta ação!!!!!');
        }
    }

}
