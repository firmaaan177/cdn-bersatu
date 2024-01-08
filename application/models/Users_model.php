<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users_model extends CI_Model
{
    //server side
    var $table = 'user'; //nama tabel dari database
    var $column_order = array(null, null, 'user.nama', 'user.email', 'user.level', 'user.status'); //field yang ada di table user
    var $column_search = array('user.nama', 'user.email', 'user.level', 'user.status'); //field yang diizin untuk pencarian 
    var $order = array('user.id_user' => 'desc'); // default order

    private function get_query()
    {
        $this->db->select('*, user.status as status_user');
        $this->db->join('user_level','user_level.id_level = user.level','left');
        $this->db->join('regional','regional.id_regional = user.id_regional','left');
        $this->db->join('dealer','dealer.id_dealer = user.id_dealer','left');
        $this->db->from('user');

        $i = 0;

        foreach ($this->column_search as $item) // looping awal
        {
            if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
            {

                if ($i === 0) // looping awal
                {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->get_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->get_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    // end server side

    public function simpan($images)
    {
        $data = [
            "id_regional" => $this->input->post('id_regional'),
            "id_dealer" => $this->input->post('id_dealer'),
            "password" => md5($this->input->post('password')),
            "email" => $this->input->post('email'),
            "nama" => $this->input->post('nama'),
            "jk" => $this->input->post('jk'),
            "nohp" => $this->input->post('nohp'),
            "alamat" => $this->input->post('alamat'),
            "level" => $this->input->post('level'),
            "status" => $this->input->post('level'),
            "image" => $images,
        ];
        $this->db->insert('user', $data);
        return;
    }

    public function edit($images, $id_user)
    {
        $data = [
            "id_regional" => $this->input->post('id_regional'),
            "id_dealer" => $this->input->post('id_dealer'),
            "email" => $this->input->post('email'),
            "nama" => $this->input->post('nama'),
            "jk" => $this->input->post('jk'),
            "nohp" => $this->input->post('nohp'),
            "alamat" => $this->input->post('alamat'),
            "level" => $this->input->post('level'),
            "status" => $this->input->post('level'),
            "image" => $images,
        ];
        $this->db->where('id_user', $id_user);
        $this->db->update('user', $data);
        return;
    }

    public function edit_status()
    {
        $data = [
            "status" => $this->input->post('status'),
        ];
        $this->db->where('id_user', $this->input->post('id_user'));
        $this->db->update('user', $data);
        return;
    }

    public function get($email)
    {
        $this->db->where('email', $email);
        $result = $this->db->get('user')->row();
        return $result;
    }

    public function auto_id()
    {
        $query = $this->db->query("SELECT MAX(id_user) as idanggota from user");
        $hasil = $query->row();
        return $hasil->idanggota;
    }

    function fetch_pass($session_id)
    {
        $fetch_pass = $this->db->query("select * from user where id_user='$session_id'");
        $res = $fetch_pass->result();
    }

    public function getRegional($id_user){
        $this->db->select('user.*, regional.*');
        $this->db->join('dealer','dealer.id_dealer = user.id_dealer','left');
        $this->db->join('regional','regional.id_regional = dealer.id_regional','left');
        $this->db->where('user.id_user', $id_user);
        return $this->db->get('user')->row_array();
    }

    function change_pass($session_id, $new_pass)
    {
        $update_pass = $this->db->query("UPDATE user set password='$new_pass'  where id_user='$session_id'");
    }

    public function log_login($id_user, $nama, $browser, $level, $os)
    {
        $data = array(
            "id_user" => $id_user,
            "nama" => $nama,
            "level" => $level,
            "browser" => $browser,
            "ip_address" => $this->input->ip_address(),
            "os" => $os,
            "created" => date("Y-m-d H:i:s"),
            "created_by" => $this->session->userdata('id_user')
        );
        $this->db->insert('log_login', $data);
        return;
    }

    public function list_user()
    {
        $this->db->order_by('id_user', 'DESC');
        return $this->db->get('user')->result_array();
    }

    public function tambahuser($foto)
    {
        $data = array(
            'id_user' => $this->input->post('id_user'),
            'nama' => $this->input->post('nama'),
            'jk' => $this->input->post('jk'),
            'nohp' => $this->input->post('nohp'),
            'alamat' => $this->input->post('alamat'),
            'status' => 'Aktif',
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')),
            'image' => $foto,
            'level' => $this->input->post('level')
        );
        $this->db->insert('user', $data);
        return;
    }

    public function edit_user()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'jk' => $this->input->post('jk'),
            'nohp' => $this->input->post('nohp'),
            'alamat' => $this->input->post('alamat'),
            'status' => $this->input->post('status'),
            'email' => $this->input->post('email'),
            'level' => $this->input->post('level')
        );
        $this->db->where('id_user', $this->input->post('id_user'));
        $this->db->update('user', $data);
        return;
    }

    public function edit_user_withfoto($foto)
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'jk' => $this->input->post('jk'),
            'nohp' => $this->input->post('nohp'),
            'alamat' => $this->input->post('alamat'),
            'status' => $this->input->post('status'),
            'email' => $this->input->post('email'),
            'image' => $foto,
            'level' => $this->input->post('level')
        );
        $this->db->where('id_user', $this->input->post('id_user'));
        $this->db->update('user', $data);
        return;
    }

    public function profil_user()
    {
        $this->db->join('user_level', 'user_level.id_level = user.level','left');
        $this->db->join('dealer', 'dealer.id_dealer = user.id_dealer','left');
        $this->db->where('user.id_user', $this->session->userdata('id_user'));
        return $this->db->get('user')->row_array();
    }

    public function detail_user($id)
    {
        $this->db->where('user.id_user', $id);
        return $this->db->get('user')->row_array();
    }

    public function getuser($id_user)
    {
        $this->db->where('id_user', $id_user);
        return $this->db->get('user')->row_array();
    }

    public function getuserdealer($id_dealer)
    {
        $this->db->where('id_dealer', $id_dealer);
        return $this->db->get('user')->row_array();
    }

    public function getUserByRegional($id_regional)
    {
        if(!empty($id_regional)){
            $this->db->where('dealer.id_regional', $id_regional);
        }
        $this->db->join('dealer', 'dealer.id_dealer = user.id_dealer','left');
        $this->db->order_by('user.nama', 'asc');
        return $this->db->get('user')->result_array();
    }


    public function getuserbydealer()
    {
        $this->db->order_by('nama', 'desc');
        return $this->db->get('user')->result_array();
    }

    function is_email_available($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get("user");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getCurrentUser()
    {
        $this->db->where('email', $_SESSION['email']);
        $result = $this->db->get('user')->row_array();
        return $result;
    }
}
