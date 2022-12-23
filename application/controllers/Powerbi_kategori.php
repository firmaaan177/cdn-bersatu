<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Powerbi_kategori extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Powerbi_kategori_model');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            $data['title'] = 'Kategori Power BI';
            $data['header'] = 'temp/header';
            $data['content'] = 'powerbi_kategori/page-powerbi-kategori';
            $this->load->view('layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
            redirect('auth/login');
        }
    }

    function get()
    {
        $list = $this->Powerbi_kategori_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {

            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = "
				<div class='btn-group'>
					<button type='button' class='btn btn-info btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Aksi <i class='mdi mdi-chevron-down'></i></button>
					<div class='dropdown-menu'>
						<a class='dropdown-item edit' href='#' data-bs-toggle='modal' data-bs-target='#modalEdit' id_powerbi_kategori='" . $field->id_powerbi_kategori . "'  nama_kategori='" . $field->nama_kategori . "'><i class='uil-edit-alt mr-1'></i> Edit</a>
					</div>
				</div>
			";
            $row[] = $field->nama_kategori;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Powerbi_kategori_model->count_all(),
            "recordsFiltered" => $this->Powerbi_kategori_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function insert()
    {
        $data = array();
        $this->form_validation->set_rules('nama_kategori','Nama powerbi_kategori','required');

        if($this->form_validation->run() != false){
            $this->Powerbi_kategori_model->insert();
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
        $this->form_validation->set_rules('nama_kategori','Nama powerbi_kategori','required');

        if($this->form_validation->run() != false){
            $this->Powerbi_kategori_model->edit();
            $data['success'] = true;
            $data['msg'] = 'Data berhasil di diperbarui!';
        }else{
            $data['success'] = false;
            $data['error'] = validation_errors();
        }
        echo json_encode($data);
    }

    public function delete($id_powerbi_kategori)
    {
        $this->Powerbi_kategori_model->delete($id_powerbi_kategori);
        $this->session->set_flashdata('message', 'Data berhasil di Hapus!');
        redirect('powerbi_kategori');
    }
}
