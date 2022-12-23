<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Powerbi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Powerbi_model');
        $this->load->model('Powerbi_kategori_model');
        $this->load->model('Regional_model');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            $data['title'] = 'Power BI';
            $data['header'] = 'temp/header';
            $data['content'] = 'powerbi/page-power-bi';
            $data['regional'] = $this->Regional_model->getregional();
            $data['kategori'] = $this->Powerbi_kategori_model->getpowerbi_kategori();
            $this->load->view('layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
            redirect('auth/login');
        }
    }

    function get()
    {
        $list = $this->Powerbi_model->get_datatables();
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
						<a class='dropdown-item edit' href='#' data-bs-toggle='modal' data-bs-target='#modalEdit' id_powerbi='" . $field->id_powerbi . "'  id_regional='" . $field->id_regional . "' id_powerbi_kategori='" . $field->id_powerbi_kategori . "'  title='" . $field->title . "' tanggal='" . $field->tanggal . "' iframe='" . $field->iframe . "' tanggal='" . $field->created_date . "' sumber_data='" . $field->sumber_data . "'><i class='uil-edit-alt mr-1'></i> Edit</a>

                        <a class='dropdown-item hapus' href='#' data-id='".$field->id_powerbi."'><i class='uil-trash-alt mr-1'></i> Hapus</a>
					</div>
				</div>
			";
            $row[] = $field->title;
            $row[] = $field->nama_kategori;
            $row[] = $field->nama_regional;
            $row[] = '<a href="'.$field->iframe.'" target="_blank">Lihat Power BI</a>';
            $row[] = $field->sumber_data;
            $row[] = date('d/m/Y', strtotime($field->tanggal));
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Powerbi_model->count_all(),
            "recordsFiltered" => $this->Powerbi_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function insert()
    {
        $data = array();
        $this->form_validation->set_rules('title','Judul','required');
		$this->form_validation->set_rules('tanggal','Tanggal','required');
		$this->form_validation->set_rules('id_regional','Regional','required');
		$this->form_validation->set_rules('id_powerbi_kategori','Kategori','required');
        $this->form_validation->set_rules('sumber_data','Sumber Data','required');
        $this->form_validation->set_rules('iframe','Iframe','required');

        if($this->form_validation->run() != false){
            $this->Powerbi_model->insert();
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
        $this->form_validation->set_rules('title','Judul','required');
		$this->form_validation->set_rules('tanggal','Tanggal','required');
		$this->form_validation->set_rules('id_regional','Regional','required');
		$this->form_validation->set_rules('id_powerbi_kategori','Kategori','required');
        $this->form_validation->set_rules('sumber_data','Sumber Data','required');
        $this->form_validation->set_rules('iframe','Iframe','required');

        if($this->form_validation->run() != false){
            $this->Powerbi_model->update();
            $data['success'] = true;
            $data['msg'] = 'Data berhasil di diperbarui!';
        }else{
            $data['success'] = false;
            $data['error'] = validation_errors();
        }
        echo json_encode($data);
    }

    public function delete($id_powerbi)
    {
        $this->Powerbi_model->delete($id_powerbi);
        $data['success'] = true;
        $data['msg'] = 'Data berhasil di hapus!';
        echo json_encode($data);
    }
}
