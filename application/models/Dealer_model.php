<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dealer_model extends CI_Model
{

    //server side
    var $table = 'dealer'; //nama tabel dari database
    var $column_order = array(null, null, null, 'dealer.kode_dealer','dealer.nama_dealer','panel.nama_panel','regional.nama_regional','regional.status'); //field yang ada di table user
    var $column_search = array('dealer.nama_dealer','dealer.nama_dealer','panel.nama_panel','regional.nama_regional','regional.status'); //field yang diizin untuk pencarian 
    var $order = array('dealer.id_dealer' => 'desc'); // default order

    private function get_query()
    {
        $this->db->select('*');
        $this->db->from('dealer');
        $this->db->join('regional','dealer.id_regional = regional.id_regional','left');
        $this->db->join('panel','dealer.id_panel = panel.id_panel','left');

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
        $id_panel = $this->input->post('id_panel');
        $data = array(
            'id_dealer' => $this->input->post('id_dealer'),
            'id_regional' => $this->input->post('id_regional'),
            'kode_dealer' => $this->input->post('kode_dealer'),
            'nama_dealer' => $this->input->post('nama_dealer'),
            'id_panel' => $this->input->post('id_panel'),
            'status' => $this->input->post('status'),
            'created_by' => $this->session->userdata('id_user'),
            'created_date' => date("Y-m-d H:i:s"),
            'edited_by' => $this->session->userdata('id_user'),
        );
        $this->db->insert('dealer', $data);
        return;
    }

    public function update()
    {
        $data = array(
            'id_dealer' => $this->input->post('id_dealer'),
            'id_regional' => $this->input->post('id_regional'),
            'kode_dealer' => $this->input->post('kode_dealer'),
            'nama_dealer' => $this->input->post('nama_dealer'),
            'id_panel' => $this->input->post('id_panel'),
            'edited_by' => $this->session->userdata('id_user'),
            'edited_date' => date("Y-m-d H:i:s"),
        );
        $this->db->where('id_dealer', $this->input->post('id_dealer'));
        $this->db->update('dealer', $data);
        return;
    }

    public function updateStatus()
    {
        $data = array(
            'status' => $this->input->post('status'),
            'edited_date' => date("Y-m-d H:i:s"),
            'edited_by' => $this->session->userdata('id_user'),
        );
        $this->db->where('id_dealer', $this->input->post('id_dealer'));
        $this->db->update('dealer', $data);
        return;
    }

    public function getDealer($id_regional = '')
    {
        if(!empty($id_regional)){
            $this->db->where('id_regional', $id_regional);
        }
        $this->db->order_by('nama_dealer', 'asc');
        return $this->db->get('dealer')->result_array();
    }

    public function getDealerbyuser(){
        $this->db->join('user','user.id_dealer = dealer.id_dealer','left');
        $this->db->where('level', 5);
        $this->db->order_by('dealer.nama_dealer', 'asc');
        $this->db->group_by('dealer.id_dealer');
        return $this->db->get('dealer')->result_array();
    }

    public function detail($id_dealer)
    {
        $this->db->where('id_dealer', $id_dealer);
        return $this->db->get('dealer')->row_array();
    }
    

    public function delete($id_dealer)
    {
        $this->db->where('id_dealer', $id_dealer);
        $this->db->delete('dealer');
    }
}
