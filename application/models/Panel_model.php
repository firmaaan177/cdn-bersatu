<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Panel_model extends CI_Model
{

    //server side
    var $table = 'panel'; //nama tabel dari database
    var $column_order = array(null, null, 'panel.nama_panel'); //field yang ada di table user
    var $column_search = array('panel.nama_panel'); //field yang diizin untuk pencarian 
    var $order = array('panel.id_panel' => 'desc'); // default order

    private function get_query()
    {
        $this->db->select('*');
        $this->db->from('panel');

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
            'id_panel' => $this->input->post('id_panel'),
            'nama_panel' => $this->input->post('nama_panel'),
            'created_by' => $this->session->userdata('id_user'),
            'created_date' => date("Y-m-d H:i:s"),
            'edited_by' => $this->session->userdata('id_user'),
        );
        $this->db->insert('panel', $data);
        return;
    }

    public function edit()
    {
        $data = array(
            'id_panel' => $this->input->post('id_panel'),
            'nama_panel' => $this->input->post('nama_panel'),
            'created_by' => $this->session->userdata('id_user'),
            'created_date' => date("Y-m-d H:i:s"),
            'edited_by' => $this->session->userdata('id_user'),
        );
        $this->db->where('id_panel', $this->input->post('id_panel'));
        $this->db->update('panel', $data);
        return;
    }

    public function getpanel()
    {
        $this->db->order_by('id_panel', 'asc');
        return $this->db->get('panel')->result_array();
    }

    public function detail($id_panel)
    {
        $this->db->where('id_panel', $id_panel);
        return $this->db->get('panel')->row_array();
    }

    public function delete($id_panel)
    {
        $this->db->where('id_panel', $id_panel);
        $this->db->delete('panel');
    }
}
