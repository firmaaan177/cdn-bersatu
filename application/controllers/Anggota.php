<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Users_model');
		$this->load->model('Jabatan_model');
		$this->load->model('Departement_model');
		is_logged_in();
	}

	public function index()
	{
		if($this->session->userdata('email')){
			$data['title'] = 'Data Anggota';
			$data['header'] = 'temp/header';
			$data['content'] = 'anggota/page-anggota';
			$data['list'] = $this->Users_model->list_user();
			$this->load->view('layout', $data);
		}else{
			$this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
			redirect('auth/login');
		}
	}

	public function add()
	{
		if($this->session->userdata('email')){
			$data['title'] = 'Tambah Anggota';
			$data['header'] = 'temp/header';
			$data['content'] = 'anggota/add-anggota';
			$data['list_jabatan'] = $this->Jabatan_model->list_jabatan();
			$data['list_departement'] = $this->Departement_model->list_departement();
			$call = $this->Users_model->auto_id();
			$urut = substr($call, 3, 4);
			$new_kode = $urut + 1;
			$data['create_id'] = $new_kode;
			$this->load->view('layout', $data);
		}else{
			$this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
			redirect('auth/login');
		}
	}

	public function insert_user(){
		$this->form_validation->set_rules('email','email','required|is_unique[user.email]');
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('pesan','email tidak tersedia!');
			redirect(base_url().'anggota/add');
        }else{
			if ($_FILES['foto']['name'] == '') {
				$foto = 'default.jpg';
				$this->Users_model->tambahuser($foto);
				$this->session->set_flashdata('message','Anggota berhasil di tambahkan!');
				redirect(base_url().'anggota');
			} else {
				$config['upload_path'] = './assets/img/foto_anggota';
				$config['allowed_types'] = 'jpg|gif|png';
				$config['file_name'] = $this->input->post('id_anggota');
	
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('foto')){
					echo "upload gagal";
					echo $this->upload->display_errors();
				}else{
					$foto = $this->upload->data('file_name');

					$config['image_library'] = 'gd2';
					$config['source_image'] = './assets/img/foto_anggota/'.$foto;
					$config['maintain_ratio'] = TRUE;
					$config['width']    = 300;
					$config['height']   = 300;
			
					$this->load->library('image_lib');
					$this->image_lib->initialize($config);
					$this->image_lib->resize();

					$this->Users_model->tambahuser($foto);
					$this->session->set_flashdata('message','Anggota berhasil di tambahkan!');
					redirect(base_url().'anggota');
				}
			}
        }
		
	}

	//edit
	public function edit($id)
	{
		if($this->session->userdata('email')){
			$data['title'] = 'Edit Anggota';
			$data['header'] = 'temp/header';
			$data['content'] = 'anggota/edit-anggota';
			$data['list_jabatan'] = $this->Jabatan_model->list_jabatan();
			$data['list_departement'] = $this->Departement_model->list_departement();
			$data['anggota'] = $this->Users_model->detail_user($id);
			$this->load->view('layout', $data);
		}else{
			$this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
			redirect('auth/login');
		}
	}

	public function edit_user()
	{
		if($this->session->userdata('email')){
			$id = $this->input->post('id_anggota');
			$path_foto = $this->input->post("id_ft");
			if ($_FILES['foto']['name'] == '') {
				$this->Users_model->edit_user();
				redirect('anggota/edit/'.$id);
			} else {
				// echo "/assets/img/foto_anggota/".$path_foto; die();
				unlink("./assets/img/foto_anggota/".$path_foto);
				$config['upload_path'] = './assets/img/foto_anggota';
				$config['allowed_types'] = 'jpg|gif|png';
				$config['file_name'] = $this->input->post('id_anggota');
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('foto')){
					echo "upload gagal";
					echo $this->upload->display_errors();
				}else{
					$foto = $this->upload->data('file_name');
					
					$config['image_library'] = 'gd2';
					$config['source_image'] = './assets/img/foto_anggota/'.$foto;
					$config['maintain_ratio'] = FALSE;
					$config['width']    = 300;
					$config['height']   = 300;
					
					$this->load->library('image_lib');
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					

					$this->Users_model->edit_user_withfoto($foto);
					$this->session->set_flashdata('message','Anggota berhasil di tambahkan!');
					redirect('anggota/edit/'.$id);
				}
			}
		}else{
			$this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
			redirect('auth/login');
		}
	}
}