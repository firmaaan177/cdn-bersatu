<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan_model');
        $this->load->model('Dealer_model');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            $data['title'] = 'Laporan';
            $data['header'] = 'temp/header';
            $data['content'] = 'laporan/page-laporan';
            $data['dealer'] = $this->Laporan_model->getDealer();
            $this->load->view('layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
            redirect('auth/login');
        }
    }

    public function filter(){
        $year = $this->input->post('year') ? $this->input->post('year') : NULL;
        $id_dealer = $this->input->post('id_dealer') ? $this->input->post('id_dealer') : NULL;

        $data = array();
        $this->form_validation->set_rules('year','Tahun','required');

        if($this->form_validation->run() != false){
            $data['dealer'] = $this->Dealer_model->detail($id_dealer);
            $data['report_nos'] = $this->Laporan_model->export_excel($year, $id_dealer);
            $data['year'] = $year;
            $data['id_dealer'] = $id_dealer;
            $data['title'] = 'Report Nos';
            $data['success'] = true;
            $data['msg'] = 'Data berhasil di tambahkan!';
            $this->load->view('laporan/page-table-report', $data);
        }else{
            $data['success'] = false;
            $data['error'] = validation_errors();
        }
        echo json_encode($data);
    }

    public function export_excel($year, $id_dealer=''){
		if($this->session->userdata('email')){
            $data['dealer'] = $this->Dealer_model->detail($id_dealer);
            $data['report_nos'] = $this->Laporan_model->export_excel($year, $id_dealer);
            $data['title'] = 'Report Nos';
            $data['success'] = true;
            $data['msg'] = 'Data berhasil di tambahkan!';
            $this->load->view('laporan/export_excel', $data);
		}else{
			$this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
			redirect('auth/login');
		}
    }
}