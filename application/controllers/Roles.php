<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Roles extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Roles_model');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            $data['title'] = 'Roles';
            $data['header'] = 'temp/header';
            $data['content'] = 'roles/page-roles';
            $data['level'] = $this->db->order_by('id_level','asc')->get('user_level')->result_array();
            $data['menu'] = $this->db->where('parent_id is null')->order_by('urutan','asc')->get('menu')->result_array();
            $data['roles'] = $this->Roles_model->getroles();
            $this->load->view('layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
            redirect('auth/login');
        }
    }

    function get()
    {
        $list = $this->Roles_model->get_datatables();
        $data = array();
        $menu = [];
        $no = $_POST['start'];
        foreach ($list as $field) {

            $id_menu = explode(',', $field->id_menu);
            $get_menu = $this->db->where_in('id_menu', $id_menu)->get('menu')->result_array();
            // var_dump($menu['nama_menu']); die();

            $no++;
            $row = array();
            $menu = array();
            $row[] = $no . ".";
            $row[] = "
				<div class='btn-group'>
					<button type='button' class='btn btn-info btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Aksi <i class='mdi mdi-chevron-down'></i></button>
					<div class='dropdown-menu'>
						<a class='dropdown-item edit' href='#' data-bs-toggle='modal' data-bs-target='#modalEdit' id_roles='" . $field->id_roles . "'  id_level='" . $field->id_level . "' id_menu='" . $field->id_menu . "'><i class='uil-edit-alt mr-1'></i> Edit</a>
					</div>
				</div>
			";
            $row[] = $field->nama_level;
            foreach($get_menu as $menu){
                $menu = $menu['nama_menu'];
            }
            $row[] = $menu;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Roles_model->count_all(),
            "recordsFiltered" => $this->Roles_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function insert()
    {
        $data = array();
        $this->form_validation->set_rules('id_level','Level User','required');
        $this->form_validation->set_rules('id_menu[]','Menu','required');

        if($this->form_validation->run() != false){
            $this->Roles_model->insert();
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
        $this->form_validation->set_rules('id_level','Level User','required');
        $this->form_validation->set_rules('id_menu[]','Menu','required');

        if($this->form_validation->run() != false){
            $this->Roles_model->edit();
            $data['success'] = true;
            $data['msg'] = 'Data berhasil di diperbarui!';
        }else{
            $data['success'] = false;
            $data['error'] = validation_errors();
        }
        echo json_encode($data);
    }

    public function delete($id_roles)
    {
        $this->Roles_model->delete($id_roles);
        $this->session->set_flashdata('message', 'Data berhasil di Hapus!');
        redirect('roles');
    }
}
