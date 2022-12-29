<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users_model');
		$this->load->model('Regional_model');
	}

	public function index()
	{
		$data['title'] = 'Login - Admin';
		$this->load->view('auth/page-login', $data);
	}

	function check_email_avalibility()
	{
		if (!filter_var($_POST["email"], FILTER_VALIDATE_DOMAIN)) {
			echo '<label class="text-danger"><span class="feather-x"></span> Invalid email</span></label>';
		} else {
			if ($this->Users_model->is_email_available($_POST["email"])) {
				echo '<label class="text-danger"><span class="feather-x"></span> email Already register</label>';
			} else {
				echo '<label class="text-success"><span class="feather-check"></span> email Available</label>';
			}
		}
	}

	public function proses_tambah()
	{
		$this->Users_model->insert_user();
		$this->session->set_flashdata('success', 'Berhasil Menambahkan Data.');
		redirect(base_url() . 'auth');
	}

	public function proses_hapus()
	{
		$this->Users_model->hapus_user($this->input->get('id'));
		$this->session->set_flashdata('success', 'Berhasil Menghapus Data.');
		redirect(base_url('auth'));
	}

	// public function proses_edit(){
	// 	$this->Users_model->edit_user();
	// 	$this->session->set_flashdata('success','Berhasil Mengedit Data.');
	// 	redirect(base_url('auth/profile'));
	// }

	public function changepass()
	{
		if ($this->session->userdata('email')) {
			$data['header'] = 'temp/header';
			$data['title'] = 'Ganti Password';
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

			$this->form_validation->set_rules('old_password', 'Password Lama', 'required|trim');
			$this->form_validation->set_rules('new_password', 'Password Baru', 'required|trim');

			if ($this->form_validation->run() == false) {
				$data['content'] = "auth/change-pass";
				$this->load->view('layout', $data);
			} else {
				$old_password = md5($this->input->post('old_password'));
				$new_password = md5($this->input->post('new_password'));

				if ($old_password != $data['user']['password']) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Password lama salah!</div>');
					redirect('auth/changepass');
				} else {
					if ($old_password == $new_password) {
						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Password Lama dan Baru tidak boleh sama!</div>');
						redirect('auth/changepass');
					} else {
						$password_hash =  md5($this->input->post('new_password'));
						$this->db->set('password', $password_hash);
						$this->db->where('email', $this->session->userdata('email'));
						$this->db->update('user');

						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Password berhasil diganti!</div>');
						redirect('auth/changepass');
					}
				}
			}
		} else {
			redirect('auth/login');
		}
	}

	public function profile()
	{
		if ($this->session->userdata('email')) {
			$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
			$data['getuser'] = $this->Users_model->profil_user();
			$data['title'] = 'Profil User';
			$data['header'] = 'temp/header';
			$data['content'] = 'auth/profile-user';
			$this->load->view('layout', $data);
		} else {
			redirect('auth/login');
		}
	}

	public function login()
	{
		$this->load->library('user_agent');
		$browser = "" . $this->agent->browser() . " " . $this->agent->version() . "";
		$os = $this->agent->platform();
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));
		$user = $this->db->query("SELECT * FROM user where email ='$email'")->row_array();
		$user_level = $this->db->query("SELECT * FROM user_level where id_level ='".$user['level']."'")->row_array();
		$regional = $this->Users_model->getRegional($user['id_user']);
		if ($user) {
			if ($password == $user['password']) {
				$session = [
					'id_user' => $user['id_user'],
					'email' => $user['email'],
					'nama' => $user['nama'],
					'level' => $user['level'],
					'nama_level' => $user_level['nama_level'],
					'image' => $user['image'],
					'status' => $user['status'],
					'id_dealer' => !empty($regional['id_dealer']) ? $regional['id_dealer'] : '',
					'id_regional' => !empty($regional['id_regional']) ? $regional['id_regional'] : 'all',
					'nama_regional' => !empty($regional['nama_regional']) ? $regional['nama_regional'] : '',
				];
				$this->session->set_userdata($session);
				if ($user['status'] == '1') {
					$this->Users_model->log_login($user['id_user'], $user['nama'], $browser, $user_level['nama_level'], $os);
					$this->session->set_flashdata('message', 'Selamat Datang Kembali, ' . $user['nama'] . '!');
					redirect('dashboard');
				} else if ($user['status'] != '1') {
					$this->session->set_flashdata('message', 'Maaf! Akun anda "Tidak Aktif" <br> Silahkan hubungi Admin.');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', 'Password yang anda masukan salah!');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', 'Email tidak ditemukan!');
			redirect('auth');
		}
	}

	public function edit_user()
	{
		if ($this->session->userdata('email')) {
			$id = $this->input->post('id_user');
			$path_foto = $this->input->post("id_ft");
			if ($_FILES['foto']['name'] == '') {
				$this->Users_model->edit_user();
				$this->session->set_flashdata('message', 'Profile berhasil diperbarui!');
				redirect('auth/profile/');
			} else {
				// echo "/assets/img/foto_anggota/".$path_foto; die();
				unlink("./assets/img/foto_anggota/" . $path_foto);
				$config['upload_path'] = './assets/img/foto_anggota';
				$config['allowed_types'] = 'jpg|gif|png';
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('foto')) {
					echo "upload gagal";
					echo $this->upload->display_errors();
				} else {
					$foto = $this->upload->data('file_name');

					$config['image_library'] = 'gd2';
					$config['source_image'] = './assets/img/foto_anggota/' . $foto;
					$config['maintain_ratio'] = FALSE;
					$config['width']    = '100%';
					$config['height']   = '100%';

					$this->load->library('image_lib');
					$this->image_lib->initialize($config);
					$this->image_lib->resize();


					$this->Users_model->edit_user_withfoto($foto);
					$this->session->set_flashdata('message', 'Profile berhasil diperbarui!');
					redirect('auth/profile/');
				}
			}
		} else {
			$this->session->set_flashdata('message', 'Anda harus Login terlebih dahulu!');
			redirect('auth/login');
		}
	}

	public function setSessions($session = ''){
		if($session == 'all'){
			$data['id_regional'] = $this->session->set_userdata('id_regional', 0);
			$data['nama_regional'] = $this->session->set_userdata('nama_regional', 'Semua Regional');
		}else{
			$regional = $this->Regional_model->detail($session);

			if(!empty($regional)){
				$data['id_regional'] = $this->session->set_userdata('id_regional', $regional['id_regional']);
				$data['nama_regional'] = $this->session->set_userdata('nama_regional', $regional['nama_regional']);
				$data['id_regional'] = $this->session->userdata('id_regional');
				$data['nama_regional'] = $this->session->userdata('nama_regional');
				$data['success'] = true;
				$data['msg'] = 'Berhasil Ganti Regional';
			}else{
				$data['success'] = false;
				$data['msg'] = 'Regional tidak ditemukan';
			}
		}
        echo json_encode($data);
	 }

	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('message', 'Berhasil logout!');
		redirect('auth');
	}
}
