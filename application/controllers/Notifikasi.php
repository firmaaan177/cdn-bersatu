<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Notifikasi extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('Pengumuman_m');
		$this->load->model('Users_model');
		$this->load->model('Nos_model');
		$this->load->model('Dealer_model');
		$this->load->model('Panel_model');
	}

    function get()
    {
        if(!empty($this->session->userdata('id_dealer'))){
            $this->db->where('nos.id_dealer', $this->session->userdata('id_dealer'));
        }
        $list = $this->Nos_model->get_datatables();
        $data = array();
        $menu = [];
        $no = $_POST['start'];
        foreach ($list as $field) {

            $nos_audit = $this->db->where('id_nos', $field->id_nos)->get('nos_audit')->row_array();
            $dealer = "<strong>$field->nama_dealer</strong><br><span>Tipe Jaringan : $field->nama_panel</span><br><span>Summited : <span class='text-danger'>Not Approve</span></span>";

            if($nos_audit == 0){
                $status = '<span class="badge rounded-pill bg-warning" style="font-size:90%">Audit sedang dilakukan</span>';
                $action = "<a class='dropdown-item' href='".base_url('nos/panel/'.encrypt_url($field->id_nos).'')."'><i class='uil-check-circle mr-1'></i> Audit Sekarang</a>";
            }else{
                $status = '<span class="badge rounded-pill bg-success" style="font-size:90%">Audit telah dilakukan</span>';
                $action = "";
            }

            if($field->hasil_sebelumnya = 80){
                $target = ''.$field->hasil_sebelumnya.'% <br><span class="badge rounded-pill bg-warning" style="font-size:90%">Gold</span>';
            }

            $no++;
            $row = array();
            $menu = array();
            $row[] = $no . ".";
            $row[] = "
				<div class='btn-group'>
					<button type='button' class='btn btn-info btn-sm dropdown-toggle' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>Aksi <i class='mdi mdi-chevron-down'></i></button>
					<div class='dropdown-menu'>
                        $action
                        <a class='dropdown-item detail' href='".base_url('nos/detail/'.encrypt_url($field->id_nos).'')."'><i class='uil-eye mr-1'></i> Detail</a>
					</div>
				</div>
			";
            $row[] = $dealer;
            $row[] = $target;
            $row[] = $status;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Nos_model->count_all(),
            "recordsFiltered" => $this->Nos_model->count_filtered(),
            "data" => $data,
        );
        //output dalam format JSON
        echo json_encode($output);
    }

    public function index(){
        if ($this->session->userdata('email')) {
            $data['dealer'] = $this->Dealer_model->getDealerbyuser();
            $data['pic_dealer'] = $this->Users_model->getuserbydealer();
            $data['nos_target'] = $this->db->order_by('id_nos_target')->get('nos_target')->result_array();
            $data['title'] = 'Notifikasi';
            $data['header'] = 'temp/header';
            $data['content'] = 'notifikasi/page-notifikasi';
            $this->load->view('layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
            redirect('auth/login');
        }
    }
}