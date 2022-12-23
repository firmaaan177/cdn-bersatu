<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Panel extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Panel_model');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            $data['title'] = 'Panel';
            $data['header'] = 'temp/header';
            $data['content'] = 'panel/page-panel';
            $this->load->view('layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
            redirect('auth/login');
        }
    }

    function get()
    {
        $list = $this->Panel_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $field) {
            $panel = [];
            $id_panel_sub = explode(',', $field->id_panel_sub);
            $get_sub = $this->db->where_in('id_panel_sub', $id_panel_sub)->get('panel_sub')->result_array();  

            foreach($get_sub as $row){
                $panel[] = '<li>'.$row['nama_panel_sub'].'</li>';

            }

            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = "
				<div class='btn-group'>
					<button type='button' class='btn btn-info btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Aksi <i class='mdi mdi-chevron-down'></i></button>
					<div class='dropdown-menu'>
						<a class='dropdown-item edit' href='#' data-bs-toggle='modal' data-bs-target='#modalEdit' id_panel='" . $field->id_panel . "'  nama_panel='" . $field->nama_panel . "'><i class='uil-edit-alt mr-1'></i> Edit</a>
					</div>
				</div>
			";
            $row[] = $field->nama_panel;
            $row[] = implode(" ", $panel);
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Panel_model->count_all(),
            "recordsFiltered" => $this->Panel_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function insert()
    {
        $data = array();
        $this->form_validation->set_rules('nama_panel','Nama panel','required');

        if($this->form_validation->run() != false){
            $this->Panel_model->insert();
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
        $this->form_validation->set_rules('nama_panel','Nama panel','required');

        if($this->form_validation->run() != false){
            $this->Panel_model->edit();
            $data['success'] = true;
            $data['msg'] = 'Data berhasil di diperbarui!';
        }else{
            $data['success'] = false;
            $data['error'] = validation_errors();
        }
        echo json_encode($data);
    }

    public function delete($id_panel)
    {
        $this->Panel_model->delete($id_panel);
        $this->session->set_flashdata('message', 'Data berhasil di Hapus!');
        redirect('panel');
    }
}
