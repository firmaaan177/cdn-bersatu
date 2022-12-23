<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Roles_model extends CI_Model
{

    //server side
    var $table = 'roles'; //nama tabel dari database
    var $column_order = array(null, null, 'roles.id_level','user_level.nama_level'); //field yang ada di table user
    var $column_search = array('roles.id_level','user_level.nama_level'); //field yang diizin untuk pencarian 
    var $order = array('roles.id_roles' => 'desc'); // default order

    private function get_query()
    {
        $this->db->select('*');
        $this->db->from('roles');
        // $this->db->join('menu','menu.id_menu = roles.id_menu','left');
        $this->db->join('user_level','user_level.id_level = roles.id_level','left');

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

    public function insert()
    {
        $data = array(
            'id_roles' => $this->input->post('id_roles'),
            'id_level' => $this->input->post('id_level'),
            'id_menu' => implode(',',$this->input->post('id_menu')),
            'created_by' => $this->session->userdata('id_user'),
            'created_date' => date("Y-m-d H:i:s"),
            'edited_by' => $this->session->userdata('id_user'),
        );
        $this->db->insert('roles', $data);
        return;
    }

    public function edit()
    {
        $data = array(
            'id_roles' => $this->input->post('id_roles'),
            'id_level' => $this->input->post('id_level'),
            'id_menu' => implode(',',$this->input->post('id_menu')),
            'created_by' => $this->session->userdata('id_user'),
            'created_date' => date("Y-m-d H:i:s"),
            'edited_by' => $this->session->userdata('id_user'),
        );
        $this->db->where('id_roles', $this->input->post('id_roles'));
        $this->db->update('roles', $data);
        return;
    }

    public function getroles()
    {
        $this->db->join('user_level','user_level.id_level = roles.id_level','left');
        $this->db->order_by('roles.id_roles', 'asc');
        return $this->db->get('roles')->result_array();
    }

    public function detail($id_roles)
    {
        $this->db->where('id_roles', $id_roles);
        return $this->db->get('roles')->row_array();
    }

    public function check_id_level($id_level)
    {
        $this->db->where('id_level', $id_level);
        return $this->db->get('roles')->row_array();
    }

    public function delete($id_roles)
    {
        $this->db->where('id_roles', $id_roles);
        $this->db->delete('roles');
    }
}
