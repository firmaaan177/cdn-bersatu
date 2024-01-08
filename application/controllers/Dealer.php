<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dealer extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dealer_model');
        $this->load->model('Regional_model');
        $this->load->model('Panel_model');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            $data['title'] = 'Dealer';
            $data['header'] = 'temp/header';
            $data['content'] = 'dealer/page-dealer';
            $data['regional'] = $this->Regional_model->getRegional();
            $data['panel'] = $this->Panel_model->getpanel();
            $this->load->view('layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
            redirect('auth/login');
        }
    }

    function get()
    {
        $list = $this->Dealer_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {

            if($field->status == 0){
                $status = '<span class="badge rounded-pill bg-danger">Tidak Aktif</span>';
                $action = "<a class='dropdown-item update-status' href='#' id_dealer='$field->id_dealer' status='1' ><i class='uil-check-circle mr-1'></i> Aktif</a>";
            }else{
                $status = '<span class="badge rounded-pill bg-success">Aktif</span>';
                $action = "<a class='dropdown-item update-status' href='#' id_dealer='$field->id_dealer' status='0' ><i class='uil-ban mr-1'></i> Tidak Aktif</a>";
            }

            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = "
				<div class='btn-group'>
					<button type='button' class='btn btn-info btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Aksi <i class='mdi mdi-chevron-down'></i></button>
					<div class='dropdown-menu'>
						<a class='dropdown-item edit' href='#' data-bs-toggle='modal' data-bs-target='#modalEdit' id_dealer='" . $field->id_dealer . "'  kode_dealer='" . $field->kode_dealer . "' id_panel='" . $field->id_panel . "' nama_dealer='" . $field->nama_dealer . "' id_regional='" . $field->id_regional . "' status='" . $field->status . "' ><i class='uil-edit-alt mr-1'></i> Edit</a>
                        
                        $action

					</div>
				</div>
			";
            $row[] = $field->kode_dealer;
            $row[] = $field->nama_dealer;
            $row[] = $field->nama_panel;
            $row[] = $field->nama_regional;
            $row[] = $status;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Dealer_model->count_all(),
            "recordsFiltered" => $this->Dealer_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function insert()
    {
        $data = array();
        $this->form_validation->set_rules('kode_dealer','Kode Dealer','required');
		$this->form_validation->set_rules('nama_dealer','Nama Dealer','required');
		$this->form_validation->set_rules('id_panel','Jenis Dealer','required');
		$this->form_validation->set_rules('id_regional','Regional','required');
		$this->form_validation->set_rules('status','Status','required');

        if($this->form_validation->run() != false){
            $this->Dealer_model->insert();
            $data['success'] = true;
            $data['msg'] = 'Data berhasil di tambahkan!';
        }else{
            $data['success'] = false;
            $data['error'] = validation_errors();
        }
        echo json_encode($data);
    }

    public function update()
    {
        $data = array();
        $this->form_validation->set_rules('kode_dealer','Kode Dealer','required');
		$this->form_validation->set_rules('nama_dealer','Nama Dealer','required');
		$this->form_validation->set_rules('id_panel','Jenis Dealer','required');
		$this->form_validation->set_rules('id_regional','Regional','required');

        if($this->form_validation->run() != false){
            $this->Dealer_model->update();
            $data['success'] = true;
            $data['msg'] = 'Data berhasil di diperbarui!';
        }else{
            $data['success'] = false;
            $data['error'] = validation_errors();
        }
        echo json_encode($data);
    }

    public function updatestatus(){
        $this->Dealer_model->updateStatus();
		$data['success'] = true;
        $data['msg'] = 'Data berhasil di diperbarui!';
        echo json_encode($data);
    }

    public function delete($id_dealer)
    {
        $this->Dealer_model->delete($id_dealer);
        $this->session->set_flashdata('message', 'Data berhasil di Hapus!');
        redirect('dealer');
    }
}
