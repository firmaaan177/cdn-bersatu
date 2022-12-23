<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('email')) {
			$this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
			redirect('auth');
		}
		$this->load->model('Setting_m');
	}

	//Setting
	public function index()
	{
		$data['title'] = 'Setting';
		$data['header'] = 'temp/header';
		$data['content'] = 'setting/page-setting';
		$this->load->view('layout', $data);
	}

	public function dataSetting()
	{
		echo json_encode($this->Setting_m->dataSetting());
	}

	function simpan($act, $id = '')
	{
		$error = '';
		$config['upload_path'] = "./assets/img/";
		$config['allowed_types'] = 'jpg|png|jpeg|JPEG';
		$config['max_size'] = 500;
		$config['encrypt_name'] = TRUE;

		$this->load->library('upload', $config);
		if ($act == 'Tambah') {
			if (!$this->upload->do_upload('logo')) {
				$error = $this->upload->display_errors();
				echo json_encode([
					'res' => false,
					'msg' => $error
				]);
			} else {
				$data = $this->upload->data();
				echo json_encode([
					'res' => $this->Setting_m->simpan($data['file_name']),
					'msg' =>  'Data di tambahkan'
				]);
			}
		} else if ($act == 'Edit' && !empty($_FILES['logo']['name'])) {
			if (!$this->upload->do_upload('logo')) {
				$error = $this->upload->display_errors();
				echo json_encode([
					'res' => false,
					'msg' => $error
				]);
			} else {
				$data = $this->upload->data();
				echo json_encode([
					'res' => $this->Setting_m->edit($data['file_name'], $id),
					'msg' =>  'Data berhasil di perbarui!'
				]);
			}
		} else if ($act == 'Edit' && empty($_FILES['logo']['name'])) {
			echo json_encode([
				'res' => $this->Setting_m->edit(NULL, $id),
				'msg' =>  'Data berhasil di perbarui!'
			]);
		} else {
			echo json_encode([
				'res' => false,
				'msg' =>  'Error'
			]);
		}
	}
	//end Setting
}
