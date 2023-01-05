<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nos extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('Pengumuman_m');
		$this->load->model('Users_model');
		$this->load->model('Nos_model');
		$this->load->model('Dealer_model');
		$this->load->model('Panel_model');
        $this->load->library('Excel');
	}

    function get()
    {
        if(!in_array($this->session->userdata('level'), explode(",",LEVEL_AKSES_ADMIN))){
            $this->db->where('nos.id_dealer', $this->session->userdata('id_dealer'));
        }else if($this->session->userdata('id_regional') != 0 && in_array($this->session->userdata('level'), explode(",",LEVEL_AKSES_ADMIN))){
            $this->db->where('regional.id_regional', $this->session->userdata('id_regional'));
        }
        $list = $this->Nos_model->get_datatables();
        $data = array();
        $menu = [];
        $no = $_POST['start'];
        foreach ($list as $field) {

            $nos_audit = $this->db->where('id_nos', $field->id_nos)->get('nos_audit')->row_array();
            $dealer = "<strong>$field->nama_dealer</strong><br><span>Tipe Panel : <strong>$field->nama_panel</strong></span>";

            if($nos_audit == 0){
                $status = '<span class="badge rounded-pill bg-warning font-size-12">Audit sedang dilakukan</span>';
                $action = "<a class='dropdown-item' href='".base_url('nos/panel/'.encrypt_url($field->id_nos).'')."'><i class='uil-check-circle mr-1'></i> Audit Sekarang</a>";
            }else{
                $status = '<span class="badge rounded-pill bg-success font-size-12" >Audit telah dilakukan</span>';
                $action = "<a class='dropdown-item' href='".base_url('nos/panel/'.encrypt_url($field->id_nos).'')."'><i class='uil-check-circle mr-1'></i> Audit Sekarang</a>";

            }

            if($field->hasil_sebelumnya >= 0 && $field->hasil_sebelumnya <= 50){
                $target = '<strong>'.$field->hasil_sebelumnya.'%</strong> <br><span class="badge rounded-pill bg-bronze font-size-12" >Bronze</span>';
            }else if($field->hasil_sebelumnya >= 51 && $field->hasil_sebelumnya <= 79){
                $target = '<strong>'.$field->hasil_sebelumnya.'%</strong> <br><span class="badge rounded-pill bg-silver font-size-12" >Silver</span>';
            }else if($field->hasil_sebelumnya >= 80 && $field->hasil_sebelumnya <= 90){
                $target = '<strong>'.$field->hasil_sebelumnya.'%</strong> <br><span class="badge rounded-pill bg-gold font-size-12" >Gold</span>';
            }else if($field->hasil_sebelumnya >= 91 && $field->hasil_sebelumnya <= 100){
                $target = '<strong>'.$field->hasil_sebelumnya.'%</strong> <br><span class="badge rounded-pill text-black bg-platinum  font-size-12" >Platinum</span>';
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
            $row[] = $field->nama_regional;
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
            $data['title'] = 'Network Operational Standart';
            $data['header'] = 'temp/header';
            $data['content'] = 'nos/page-nos';
            $this->load->view('layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
            redirect('auth/login');
        }
    }

    public function import(){
        if ($this->session->userdata('email')) {
            $data['title'] = 'Import Excel';
            $data['header'] = 'temp/header';
            $data['content'] = 'nos/import-excel';
            $this->load->view('layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
            redirect('auth/login');
        }
    }

    public function import_excel(){
		if (isset($_FILES["fileExcel"]["name"])) {
			$path = $_FILES["fileExcel"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();	
				for($row=2; $row<=$highestRow; $row++)
				{
					$nama = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$jurusan = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$angkatan = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$temp_data[] = array(
						'nama'	=> $nama,
						'jurusan'	=> $jurusan,
						'angkatan'	=> $angkatan
					); 	
				}
			}
			$insert = $this->Nos_model->import_excel($temp_data);
			if($insert){
				$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-ok"></span> Data Berhasil di Import ke Database');
				redirect(base_url().'nos/import');
			}else{
				$this->session->set_flashdata('status', '<span class="glyphicon glyphicon-remove"></span> Terjadi Kesalahan');
				redirect(base_url().'nos/import');
			}
		}else{
			echo "Tidak ada file yang masuk";
		}
	}

    public function panel($id_nos){
        if ($this->session->userdata('email')) {
            $data['title'] = 'Daftar Panel';
            $data['header'] = 'temp/header';
            $data['nos'] = $this->Nos_model->getNosComplete(decrypt_url($id_nos));
            $data['id_dealer'] = $data['nos']['id_regional'];
            if($this->session->userdata('id_regional') == 0 || $this->session->userdata('id_regional') == $data['nos']['id_regional']){
                $data['content'] = 'nos/page-panel';
            }else{
                $data['content'] = '404';
            }
            $id_panel_sub = explode(',', $data['nos']['id_panel_sub']);
            $data['sub_panel'] = $this->Nos_model->getPanelSub($id_panel_sub)->result_array();
            $data['persentase'] = $this->persentaseTotalNos($id_panel_sub);
            $this->load->view('layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
            redirect('auth/login');
        }
    }

    public function item($id_nos, $id_panel_sub){
        if ($this->session->userdata('email')) {
            $data['id_nos'] = decrypt_url($id_nos);
            $data['title'] = 'Daftar Item';
            $data['header'] = 'temp/header';
            $data['nos_data'] = $this->Nos_model->getItemNosData(decrypt_url($id_panel_sub));
            $data['nos'] = $this->Nos_model->getNosComplete(decrypt_url($id_nos));
            if($this->session->userdata('id_regional') == 0 || $this->session->userdata('id_regional') == $data['nos']['id_regional']){
                $data['content'] = 'nos/page-item';
            }else{
                $data['content'] = '404';
            }
            $id_sub = explode(',', $data['nos']['id_panel_sub']);
            $data['persentase'] = $this->persentaseTotalNos(decrypt_url($id_nos), $id_sub);
            $data['sub_panel'] = $this->Nos_model->getPanelSub(decrypt_url($id_panel_sub))->row_array();
            // var_dump($this->db->last_query());die();
            $data['year'] = date('Y');
            $this->load->view('layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
            redirect('auth/login');
        }
    }

    public function sub_item($id_nos, $id_panel_sub, $item){
        if ($this->session->userdata('email')) {
            $url = urldecode($item);
            $data['id_nos'] = decrypt_url($id_nos);
            $data['title'] = 'Daftar Sub Item';
            $data['header'] = 'temp/header';
            $data['nos_data'] = $this->Nos_model->sub_item($url);
            $data['nos'] = $this->Nos_model->getNosComplete(decrypt_url($id_nos));
            if($this->session->userdata('id_regional') == 0 || $this->session->userdata('id_regional') == $data['nos']['id_regional']){
                $data['content'] = 'nos/page-sub-item';
            }else{
                $data['content'] = '404';
            }
            $id_sub = explode(',', $data['nos']['id_panel_sub']);
            $data['persentase'] = $this->persentaseTotalNos($id_sub);
            $data['sub_panel'] = $this->Nos_model->detail_sub_panel(decrypt_url($id_panel_sub));
            $data['year'] = date('Y');
            $this->load->view('layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
            redirect('auth/login');
        }
    }

    public function sub_item_detail($id_nos, $id_panel_sub, $id_nos_data){
        if ($this->session->userdata('email')) {
            $data['title'] = 'Daftar Sub Item';
            $data['header'] = 'temp/header';
            $data['nos_data'] = $this->Nos_model->sub_item_detail(decrypt_url($id_nos_data));
            $data['nos'] = $this->Nos_model->getNosComplete(decrypt_url($id_nos));
            if($this->session->userdata('id_regional') == 0 || $this->session->userdata('id_regional') == $data['nos']['id_regional']){
                $data['content'] = 'nos/page-sub-item-detail';
            }else{
                $data['content'] = '404';
            }
            $data['pic_nos'] = $this->Nos_model->getPicNos($data['nos']['id_dealer']);
            $id_sub = explode(',', $data['nos']['id_panel_sub']);
            $data['persentase'] = $this->persentaseTotalNos($id_sub);
            $data['sub_panel'] = $this->Nos_model->detail_sub_panel(decrypt_url($id_panel_sub));
            $this->load->view('layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
            redirect('auth/login');
        }
    }

    public function sub_item_edit($id_nos, $id_panel_sub, $id_nos_data, $id_nos_audit){
        if ($this->session->userdata('email')) {
            $data['title'] = 'Edit Audit';
            $data['header'] = 'temp/header';
            $data['nos_data'] = $this->Nos_model->sub_item_detail(decrypt_url($id_nos_data));
            $data['nos'] = $this->Nos_model->getNosComplete(decrypt_url($id_nos));
            if($this->session->userdata('id_regional') == 0 || $this->session->userdata('id_regional') == $data['nos']['id_regional']){
                $data['content'] = 'nos/page-sub-item-edit';
            }else{
                $data['content'] = '404';
            }
            // var_dump($this->db->last_query());die();

            $data['edit'] = $this->Nos_model->getAudit(decrypt_url($id_nos_audit));
            // var_dump($data['nos']);die();
            
            $data['pic_nos'] = $this->Nos_model->getPicNos($data['nos']['id_dealer']);
            $id_sub = explode(',', $data['nos']['id_panel_sub']);
            $data['persentase'] = $this->persentaseTotalNos($id_sub);
            $data['sub_panel'] = $this->Nos_model->detail_sub_panel(decrypt_url($id_panel_sub));
            $this->load->view('layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
            redirect('auth/login');
        }
    }

    public function detail($id_nos){
        if ($this->session->userdata('email')) {
            $data['title'] = 'Detail';
            $data['header'] = 'temp/header';
            $data['content'] = 'nos/page-detail';
            $data['nos'] = $this->Nos_model->getNosComplete(decrypt_url($id_nos));
            // var_dump($data['nos']);die();
            if($this->session->userdata('id_regional') == 0 || $this->session->userdata('id_regional') == $data['nos']['id_regional']){
                $data['content'] = 'nos/page-detail';
            }else{
                $data['content'] = '404';
            }
            $data['id_dealer'] = $data['nos']['id_dealer'];
            $id_panel_sub = explode(',', $data['nos']['id_panel_sub']);
            $data['sub_panel'] = $this->db->where_in('id_panel_sub', $id_panel_sub)->get('panel_sub')->result_array();
            $data['persentase'] = $this->persentaseTotalNos($id_panel_sub);
            $data['nos_data'] = $this->Nos_model->mot($data['nos']['id_dealer'], $id_panel_sub);
            // echo "<pre>"; var_dump($data['nos_data']);die();
            // var_dump($this->db->last_query());die();
            $data['komentar_mot'] = $this->Nos_model->komentar_mot($data['nos']['id_dealer']);
            $data['komentar_nos'] = $this->Nos_model->komentar_nos(decrypt_url($id_nos));
            $this->load->view('layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
            redirect('auth/login');
        }
    }

    public function detail_mot($id_nos, $mot){
        if ($this->session->userdata('email')) {
            $mot = str_replace("dan", "&", $mot);
            $url = urldecode($mot);
            $data['title'] = 'Detail';
            $data['header'] = 'temp/header';
            $data['content'] = 'nos/page-detail-mot';
            $data['nos'] = $this->Nos_model->getNosComplete(decrypt_url($id_nos));
            if($this->session->userdata('id_regional') == 0 || $this->session->userdata('id_regional') == $data['nos']['id_regional']){
                $data['content'] = 'nos/page-detail-mot';
            }else{
                $data['content'] = '404';
            }
            $data['nos_data'] = $this->Nos_model->detail_mot($data['nos']['id_dealer'], $url);
            // echo "<pre>"; var_dump($data['nos']);die();

            $id_panel_sub = explode(',', $data['nos']['id_panel_sub']);
            $data['sub_panel'] = $this->db->where_in('id_panel_sub', $id_panel_sub)->get('panel_sub')->result_array();
            $data['persentase'] = $this->persentaseTotalNos($id_panel_sub);
            $this->load->view('layout', $data);
        } else {
            $this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
            redirect('auth/login');
        }
    }

    public function report_nos(){
        if ($this->session->userdata('email')) {
            $data['dealer'] = $this->Dealer_model->detail($this->session->userdata('id_dealer'));
            $data['report_nos'] = $this->Nos_model->report_nos();
            $data['title'] = 'Report Nos';
            $this->load->view('nos/report_nos', $data);
        } else {
            $this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
            redirect('auth/login');
        }
    }

    public function insert()
    {
        $check_nos = $this->Nos_model->checkNosByDealer($this->input->post('id_dealer'));

        if(empty($check_nos)){
            $data = array();
            $this->form_validation->set_rules('id_dealer','Dealer','required');
            $this->form_validation->set_rules('id_user','PIC Dealer','required');
            $this->form_validation->set_rules('id_nos_target[]','Target','required');
            $this->form_validation->set_rules('hasil_sebelumnya[]','Hasil Nos','required');
    
            if($this->form_validation->run() != false){
                $this->Nos_model->insert();
                $data['success'] = true;
                $data['msg'] = 'Data berhasil di tambahkan!';
            }else{
                $data['success'] = false;
                $data['error'] = validation_errors();
            }
        }else{
            $data['success'] = false;
            $data['error'] = 'Gagal, Dealer tersebut telah tersedia.';
        }
        
        echo json_encode($data);
    }

    public function insert_audit()
    {
        $data = array();
        $this->form_validation->set_rules('nilai','Penilaian','required');
        $this->form_validation->set_rules('pic','People in Charge (PIC)','required');
        $this->form_validation->set_rules('due_date','Due Date','required');
        $this->form_validation->set_rules('penjelasan','Penjelasan','required');

        $config['upload_path']="./upload/audit";
		$config['allowed_types']='jpg|png|jpeg|JPEG';
		$config['max_size'] = 1000;
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);

        if($this->form_validation->run() != false){
            if (!empty($_FILES['foto']['name'])) {
				if ( ! $this->upload->do_upload('foto')){
					$error = $this->upload->display_errors();
					$data['msg'] = $error;
				}else{
					$upload = $this->upload->data();
                    $this->Nos_model->insert_audit($upload['file_name']);
				}
			} else if (empty($_FILES['foto']['name'])) {
                $this->Nos_model->insert_audit('default.jpg');
			}
            $data['success'] = true;
            $data['msg'] = 'Data berhasil di Audit';
        }else{
            $data['success'] = false;
            $data['error'] = validation_errors();
        }
        echo json_encode($data);
    }

    public function edit_audit($id)
    {
        $data_audit = $this->db->where('id_nos_audit', $id)->get('nos_audit')->row_array();

        $data = array();
        $this->form_validation->set_rules('nilai','Penilaian','required');
        $this->form_validation->set_rules('pic','People in Charge (PIC)','required');
        $this->form_validation->set_rules('due_date','Due Date','required');
        $this->form_validation->set_rules('penjelasan','Penjelasan','required');

        $config['upload_path']="./upload/audit";
		$config['allowed_types']='jpg|png|jpeg|JPEG';
		$config['max_size']=500;
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);

        if($this->form_validation->run() != false){
            if (!empty($_FILES['foto']['name'])) {
				if ( ! $this->upload->do_upload('foto')){
					$error = $this->upload->display_errors();
					$data['msg'] = $error;
				}else{
					$upload = $this->upload->data();
                    $this->Nos_model->edit_audit($upload['file_name'], $id);
				}
			} else if (empty($_FILES['foto']['name'])) {
                $this->Nos_model->edit_audit($data_audit['foto'], $id);
			}
            $data['success'] = true;
            $data['msg'] = 'Data Audit berhasil diperbarui';
        }else{
            $data['success'] = false;
            $data['error'] = validation_errors();
        }
        echo json_encode($data);
    }

    public function insert_perbaikan()
    {
        $data = array();
        $this->form_validation->set_rules('id_nos_audit','Text','required');
        $this->form_validation->set_rules('keterangan','Keterangan','required');

        $config['upload_path']="./upload/perbaikan";
		$config['allowed_types']='jpg|png|jpeg|JPEG';
		$config['max_size']=500;
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
        // var_dump($_FILES['foto']['name']); die();

        if($this->form_validation->run() != false){
            if (!empty($_FILES['foto']['name'])) {
				if ( ! $this->upload->do_upload('foto')){
					$error = $this->upload->display_errors();
					$data['msg'] = $error;
				}else{
					$upload = $this->upload->data();
                    $this->Nos_model->insert_perbaikan($upload['file_name']);
                    $this->Nos_model->is_perbaikan();
				}
			} else if (empty($_FILES['foto']['name'])) {
                $this->Nos_model->insert_perbaikan('default.jpg');
			}
            $data['success'] = true;
            $data['msg'] = 'Data berhasil di Simpan';
        }else{
            $data['success'] = false;
            $data['error'] = validation_errors();
        }
        echo json_encode($data);
    }

    public function approve(){
        $this->Nos_model->approve();
        $this->Nos_model->approve_perbaikan();
		$data['success'] = true;
        $data['msg'] = 'Data berhasil di Approve!';
        echo json_encode($data);
    }

    public function approve_by_mot(){
        $this->Nos_model->approve_by_mot();
		$data['success'] = true;
        $data['msg'] = 'Data berhasil di Approve!';
        echo json_encode($data);
    }

    public function lock_nos($id_dealer=''){
        $this->Nos_model->lock_nos($id_dealer);
		$data['success'] = true;
        $data['msg'] = 'Data berhasil di LOCK!';
        echo json_encode($data);
    }

    public function add_comment(){
        $this->Nos_model->add_comment();
		$data['success'] = true;
        $data['msg'] = 'Komentar berhasil ditambahkan!';
        echo json_encode($data);
    }

    public function add_comment_nos(){
        $data = array();
        $this->form_validation->set_rules('komentar','Komentar','required');

        if($this->form_validation->run() != false){
            $this->Nos_model->add_comment_nos();
            $data['success'] = true;
            $data['msg'] = 'Komentar di tambahkan!';
        }else{
            $data['success'] = false;
            $data['error'] = validation_errors();
        }
        echo json_encode($data);
    }

    public function perbaikan(){
        $this->Nos_model->perbaikan();
		$data['success'] = true;
        $data['msg'] = 'Data berhasil diperbarui!';
        echo json_encode($data);
    }

    public function persentaseTotalNos($id_panel_sub){
        $sub_panel = $this->db->where_in('id_panel_sub', $id_panel_sub)->get('panel_sub')->result_array();
        $nilai_nos = 0;
        foreach($sub_panel as $row) {
            if(substr($row['nama_panel_sub'], 2) == ' People'){
                $nilai_custom = 0.5;
             }else{
                $nilai_custom = -1;
            }
            $total_exist_good = 0;
            $total_not_exist_good = 0;
            $total_not_exist = 0;
            $total_audit = 0;
            $master_nos = $this->db->where('id_panel_sub', $row['id_panel_sub'])->get('nos_data')->result_array();
            $exist_good = $this->db->where('id_panel_sub', $row['id_panel_sub'])->where('nilai', 1)->get('nos_audit')->result_array();
            $not_exist_good = $this->db->where('id_panel_sub', $row['id_panel_sub'])->where('nilai', $nilai_custom)->get('nos_audit')->result_array();
            $not_exist = $this->db->where('id_panel_sub', $row['id_panel_sub'])->where('nilai', 0)->get('nos_audit')->result_array();
            $audit = $this->db->where('id_panel_sub', $row['id_panel_sub'])->get('nos_audit')->result_array();
    
            foreach($audit as $rows){
                if($rows['nilai'] == 1){
                    $total_exist_good = count($exist_good) * 1;
                }else if($rows['nilai'] == -1){
                    $total_not_exist_good = count($not_exist_good) * $nilai_custom;
                }else if($rows['nilai'] == 0){
                    $total_not_exist = count($not_exist) * 0;
                }else{
                    $na = NULL;
                }
            }
            if($audit > 0){
                $total = ($total_exist_good + $total_not_exist_good + $total_not_exist) / count($master_nos)*100;
                $nilai_nos += $total/count($sub_panel);
            }else{
                $total = 0;
            }
        }
        return $nilai_nos;
    }
}