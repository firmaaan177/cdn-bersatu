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
		$this->load->model('Regional_model');
        $this->load->model('Dealer_model');
		
	}

	public function index()
	{
		if ($this->session->userdata('email')) {
			$id_regional = '';
			$id_user = '';
			if($this->session->userdata('id_regional') != 0){
				$id_regional = $this->session->userdata('id_regional');
			}
			$data['title'] = 'Dashboard';
            $data['powerbi'] = $this->Powerbi_model->getPowerBi($id_regional,$this->session->userdata('id_dealer'), $this->session->userdata('id_user'));
			// var_dump($this->db->last_query());die();
			$data['log_login'] = $this->Dashboard_model->log_login();
			$data['regional'] = $this->Regional_model->getRegional();
            $data['dealer'] = $this->Dealer_model->getDealer($id_regional);
            $data['user'] = $this->Users_model->list_user();
			$data['header'] = 'temp/header';
			$data['content'] = 'dashboard/dashboard';
			$this->load->view('layout', $data);
		} else {
			$this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
			redirect('auth');
		}
	}

	public function filter(){
        $id_dealer = $this->input->post('id_dealer') ? $this->input->post('id_dealer') : NULL;

		$data['powerbi'] = $this->Powerbi_model->getPowerBiForFilter($id_dealer);
		$data['title'] = 'Dashboard';
		$data['success'] = true;
		$data['msg'] = 'Berhasil!';
		$this->load->view('dashboard/load-dashboard', $data);
        // echo json_encode($data);
	}

	public function powerbi($id_powerbi){
		if ($this->session->userdata('email')) {
			$data['title'] = 'Dashboard';
			$data['log_login'] = $this->Dashboard_model->log_login();
			$data['powerbi'] = $this->Powerbi_model->detail(decrypt_url($id_powerbi));
			if(!empty($data['powerbi'])){
				$data['author'] = $this->Users_model->getuser($data['powerbi']['created_by']);
			}
			$data['kategori'] = $this->Powerbi_kategori_model->detail(decrypt_url($data['powerbi']['id_powerbi_kategori']));
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
