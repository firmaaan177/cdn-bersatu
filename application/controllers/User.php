<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('email')){
			$this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
			redirect('auth');
		}
		$this->load->model('Users_model');
		$this->load->model('Dealer_model');
	}

	//user
	public function index()
	{
		$data['title'] = 'User';
		$data['header'] = 'temp/header';
		$data['content'] = 'user/page-user';
		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$data['title'] = 'Tambah Data User';
		$data['header'] = 'temp/header';
		$data['content'] = 'user/add-user';
		$data['level'] = $this->db->get('user_level')->result_array();
		$data['dealer'] = $this->Dealer_model->getdealer();
		$this->load->view('layout', $data);
	}

	public function edit($id = '')
	{
		$data['level'] = $this->db->get('user_level')->result_array();
		$data['dealer'] = $this->Dealer_model->getdealer();
		$data['detail'] = $this->Users_model->detail_user(decrypt_url($id));
		$data['title'] = 'Edit User';
		$data['header'] = 'temp/header';
		$data['content'] = 'user/edit-user';
		$this->load->view('layout', $data);
	}

	public function lihat($id = '')
	{
		$data['detail'] = $this->Users_model->detail_user(decrypt_url($id));
		$data['title'] = 'Detail User';
		$data['header'] = 'temp/header';
		$data['content'] = 'user/detail-user';
		$this->load->view('layout', $data);
	}

	function get(){
		$list = $this->Users_model->get_datatables();
        $data = array();
		$no = $_POST['start'];
        foreach ($list as $field) {

			if($field->status_user == 1){
                $status = '<span class="badge rounded-pill bg-success">Aktif</span>';
				$action = "<a class='dropdown-item edit-status' id_user='".$field->id_user."' status='0' href='javascript:void(0)'><i class='uil-times mr-1'></i> Non Aktif</a>";
            }else{
				$status = '<span class="badge rounded-pill bg-danger">Tidak Aktif</span>';
				$action = "<a class='dropdown-item edit-status' id_user='".$field->id_user."' status='1' href='javascript:void(0)'><i class='uil-check mr-1'></i> Aktif</a>";
            }

            $no++;
            $row = array();
			$row[] = $no.".";
			$row[] = "
				<div class='btn-group'>
					<button class='btn btn-info btn-sm dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
						Aksi <i class='mdi mdi-chevron-down'></i>
					</button>
					<div class='dropdown-menu'>
							<a class='dropdown-item' href='".base_url()."user/lihat/".encrypt_url($field->id_user)."'><i class='uil-eye mr-1'></i> Lihat</a>
							<a class='dropdown-item' href='".base_url()."user/edit/".encrypt_url($field->id_user)."'><i class='uil-edit-alt mr-1'></i> Edit</a>
							$action
						</div>
				</div>";
            $row[] = "<img width='40' src='".base_url().'assets/img/foto_anggota/'.$field->image."' alt='' style='border-radius:5px;'>";
            $row[] = $field->nama."<br>".$field->nohp;
            $row[] = $field->email;
            $row[] = $field->nama_level;
            $row[] = $field->nama_dealer;
            $row[] = $status;
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Users_model->count_all(),
            "recordsFiltered" => $this->Users_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
	}

	public function datauserDetail()
	{
		$id_user = $this->input->post('id_user');
		echo json_encode($this->Users_model->datauserDetail($id_user));
	}
	public function hapususer()
	{
		$id_user = $this->input->post('id');
		echo json_encode($this->Users_model->hapususer($id_user));
	}
	public function datauser()
	{
		echo json_encode($this->Users_model->datauser());
	}
	
	public function insert()
    {
        $data = array();
		$this->form_validation->set_rules('email','Email','required|is_unique[user.email]');
		;
        $this->form_validation->set_rules('nama','Nama Lengkap','required');
        $this->form_validation->set_rules('jk','Jenis Kelamin','required');
        $this->form_validation->set_rules('nohp','No Hp','required');
        $this->form_validation->set_rules('alamat','Alamat','required');
        $this->form_validation->set_rules('level','Hak Akses','required');


		$config['upload_path']="./assets/img/foto_anggota";
		$config['allowed_types']='jpg|png|jpeg|JPEG';
		$config['max_size']=1000;
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);

        if($this->form_validation->run() != false){
			if (!empty($_FILES['image']['name'])) {
				if ( ! $this->upload->do_upload('image')){
					$error = $this->upload->display_errors();
					$msg = $error;
					$action = false;
				}else{
					$upload = $this->upload->data();
					$this->Users_model->simpan($upload['file_name']);
					$msg = 'Data berhasil disimpan';
					$action = true;
				}
			} else if (empty($_FILES['image']['name'])) {
				$this->Users_model->simpan('default.jpg');
				$msg = 'Data berhasil disimpan';
				$action = true;
			}
            $data['success'] = $action;
            $data['msg'] = $msg;
			$this->session->set_flashdata('message', $msg);
			$data['redirect'] = base_url('user');
        }else{
			$data['success'] = false;
            $data['msg'] = validation_errors();
        }
        echo json_encode($data);
    }

	public function update($id_user)
    {
		$data_user = $this->db->where('id_user', $id_user)->get('user')->row_array();
        $data = array();
		$this->form_validation->set_rules('email','Email','required');
		;
        $this->form_validation->set_rules('nama','Nama Lengkap','required');
        $this->form_validation->set_rules('jk','Jenis Kelamin','required');
        $this->form_validation->set_rules('nohp','No Hp','required');
        $this->form_validation->set_rules('alamat','Alamat','required');
        $this->form_validation->set_rules('level','Hak Akses','required');


		$config['upload_path']="./assets/img/foto_anggota";
		$config['allowed_types']='jpg|png|jpeg|JPEG';
		$config['max_size']=1000;
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);

        if($this->form_validation->run() != false){
			if (!empty($_FILES['image']['name'])) {
				if ( ! $this->upload->do_upload('image')){
					$error = $this->upload->display_errors();
					$msg = $error;
					$action = false;
				}else{
					$upload = $this->upload->data();
					$this->Users_model->edit($upload['file_name'], $id_user);
					$msg = 'Data berhasil diperbarui';
					$action = true;
				}
			} else if (empty($_FILES['image']['name'])) {
				$this->Users_model->edit($data_user['image'], $id_user);
				$msg = 'Data berhasil diperbarui';
				$action = true;
			}
            $data['success'] = $action;
            $data['msg'] = $msg;
			$this->session->set_flashdata('message', $msg);
			$data['redirect'] = base_url('user');
        }else{
			$data['success'] = false;
            $data['msg'] = validation_errors();
        }
        echo json_encode($data);
    }

	public function changeStatus(){
        $this->Users_model->edit_status();
		$data['success'] = true;
        $data['msg'] = 'Data berhasil diperbarui!';
        echo json_encode($data);
    }

}
