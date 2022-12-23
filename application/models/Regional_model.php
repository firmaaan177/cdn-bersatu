<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Regional_model extends CI_Model
{

    //server side
    var $table = 'regional'; //nama tabel dari database
    var $column_order = array(null, null, 'regional.nama_regional'); //field yang ada di table user
    var $column_search = array('regional.nama_regional'); //field yang diizin untuk pencarian 
    var $order = array('regional.id_regional' => 'desc'); // default order

    private function get_query()
    {
        $this->db->select('*');
        $this->db->from('regional');

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
            'id_regional' => $this->input->post('id_regional'),
            'nama_regional' => $this->input->post('nama_regional'),
            'created_by' => $this->session->userdata('id_user'),
            'created_date' => date("Y-m-d H:i:s"),
            'edited_by' => $this->session->userdata('id_user'),
        );
        $this->db->insert('regional', $data);
        return;
    }

    public function edit()
    {
        $data = array(
            'id_regional' => $this->input->post('id_regional'),
            'nama_regional' => $this->input->post('nama_regional'),
            'created_by' => $this->session->userdata('id_user'),
            'created_date' => date("Y-m-d H:i:s"),
            'edited_by' => $this->session->userdata('id_user'),
        );
        $this->db->where('id_regional', $this->input->post('id_regional'));
        $this->db->update('regional', $data);
        return;
    }

    public function getregional()
    {
        $this->db->order_by('id_regional', 'asc');
        return $this->db->get('regional')->result_array();
    }

    public function detail($id_regional)
    {
        $this->db->where('id_regional', $id_regional);
        return $this->db->get('regional')->row_array();
    }

    public function delete($id_regional)
    {
        $this->db->where('id_regional', $id_regional);
        $this->db->delete('regional');
    }
}
