<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_model');
		$this->load->model('Users_model');
		$this->load->model('Powerbi_model');
		$this->load->model('Powerbi_kategori_model');
	}

	public function index()
	{
		if ($this->session->userdata('email')) {
			$data['title'] = 'Dashboard';
            $data['kategori'] = $this->Powerbi_kategori_model->getpowerbi_kategori();
			$data['log_login'] = $this->Dashboard_model->log_login();
			$data['header'] = 'temp/header';
			$data['content'] = 'dashboard/dashboard';
			$this->load->view('layout', $data);
		} else {
			$this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
			redirect('auth');
		}
	}

	public function detail($id_powerbi_kategori){
		if ($this->session->userdata('email')) {
			$regional = $this->Users_model->getRegional($this->session->userdata('id_user'));
			if(empty($regional['id_dealer']) || $regional['id_dealer'] == 0){
				$data['title'] = 'Dashboard';
			}else{
				$data['title'] = 'Dashboard Regional '.$regional['nama_regional'].'';
			}
			$data['log_login'] = $this->Dashboard_model->log_login();
			$data['powerbi'] = $this->Powerbi_model->getpowerbi_by_regional(decrypt_url($id_powerbi_kategori));
			if(!empty($data['powerbi'])){
				$data['author'] = $this->Users_model->getuser($data['powerbi']['created_by']);
			}
			$data['kategori'] = $this->Powerbi_kategori_model->detail(decrypt_url($id_powerbi_kategori));
			$data['header'] = 'temp/header';
			$data['content'] = 'dashboard/detail';
			$this->load->view('layout', $data);
		} else {
			$this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
			redirect('auth');
		}
	}

	public function grafik_visitor()
	{
		echo json_encode($this->Dashboard_model->grafik_visitor());
	}
}
