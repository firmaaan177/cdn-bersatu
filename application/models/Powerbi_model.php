<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Powerbi_model extends CI_Model
{

    //server side
    var $table = 'powerbi'; //nama tabel dari database
    var $column_order = array(null, null, 'powerbi.title','powerbi_kategori.nama_kategori','regional.nama_regional', null,'powerbi.sumber_data','powerbi.tanggal'); //field yang ada di table user
    var $column_search = array('regional.nama_regional','powerbi_kategori.nama_kategori','powerbi.title','powerbi.sumber_data','powerbi.tanggal'); //field yang diizin untuk pencarian 
    var $order = array('powerbi.id_powerbi' => 'desc'); // default order

    private function get_query()
    {
        $this->db->select('*');
        $this->db->from('powerbi');
        $this->db->join('regional','powerbi.id_regional = regional.id_regional','left');
        $this->db->join('powerbi_kategori','powerbi_kategori.id_powerbi_kategori = powerbi.id_powerbi_kategori','left');

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
        if(!empty($this->input->post('id_user'))){
            $id_user = implode(',',$this->input->post('id_user'));
        }else{
            $id_user = '';
        }
        if(!empty($this->input->post('id_dealer'))){
            $id_dealer = implode(',',$this->input->post('id_dealer'));
        }else{
            $id_dealer = $this->input->post('id_dealer');
        }
        $data = array(
            'id_regional' => $this->input->post('id_regional'),
            'id_dealer' => $id_dealer,
            'id_user' => $id_user,
            'id_powerbi_kategori' => $this->input->post('id_powerbi_kategori'),
            'title' => $this->input->post('title'),
            'tanggal' => $this->input->post('tanggal'),
            'iframe' => $this->input->post('iframe'),
            'sumber_data' => $this->input->post('sumber_data'),
            'created_by' => $this->session->userdata('id_user'),
            'created_date' => date("Y-m-d H:i:s"),
            'edited_by' => $this->session->userdata('id_user'),
        );
        $this->db->insert('powerbi', $data);
        return;
    }

    public function update()
    {
        if(!empty($this->input->post('id_user'))){
            $id_user = implode(',',$this->input->post('id_user'));
        }else{
            $id_user = '';
        }
        if(!empty($this->input->post('id_dealer'))){
            $id_dealer = implode(',',$this->input->post('id_dealer'));
        }else{
            $id_dealer = $this->input->post('id_dealer');
        }
        $data = array(
            'id_regional' => $this->input->post('id_regional'),
            'id_dealer' => $id_dealer,
            'id_user' => $id_user,
            'id_powerbi_kategori' => $this->input->post('id_powerbi_kategori'),
            'title' => $this->input->post('title'),
            'tanggal' => $this->input->post('tanggal'),
            'iframe' => $this->input->post('iframe'),
            'sumber_data' => $this->input->post('sumber_data'),
            'edited_by' => $this->session->userdata('id_user'),
            'edited_date' => date("Y-m-d H:i:s"),
        );
        $this->db->where('id_powerbi', $this->input->post('id_powerbi'));
        $this->db->update('powerbi', $data);
        return;
    }


    public function getpowerbi_by_regional($id_powerbi_kategori)
    {
        $this->db->where('id_powerbi_kategori', $id_powerbi_kategori);
        $this->db->where('id_regional', $this->session->userdata('id_regional'));
        $this->db->order_by('created_date', 'desc');
        return $this->db->get('powerbi')->row_array();
    }

    public function getPowerBi($id_regional = '', $id_dealer ='', $id_user='')
    {
        if(!empty($id_regional)){
            $this->db->where('powerbi.id_regional', $id_regional,'both');
        }
        if(!empty($id_dealer)){
            $this->db->or_like('powerbi.id_dealer', $id_dealer,'both');
        }
        if(!in_array($this->session->userdata('level'), explode(",",LEVEL_AKSES_ADMIN))){
            $this->db->or_like('powerbi.id_user', $id_user, 'both');
        }
        $this->db->join('powerbi_kategori', 'powerbi_kategori.id_powerbi_kategori = powerbi.id_powerbi_kategori','left');
        $this->db->join('regional', 'regional.id_regional = powerbi.id_regional','left');
        $this->db->order_by('powerbi.id_powerbi', 'asc');
        return $this->db->get('powerbi')->result_array();
    }

    public function getPowerBiForFilter($id_dealer ='')
    {
        if(!empty($id_dealer)){
            $this->db->where('powerbi.id_dealer', $id_dealer);
        }
        $this->db->join('powerbi_kategori', 'powerbi_kategori.id_powerbi_kategori = powerbi.id_powerbi_kategori','left');
        $this->db->join('regional', 'regional.id_regional = powerbi.id_regional','left');
        $this->db->order_by('powerbi.id_powerbi', 'asc');
        return $this->db->get('powerbi')->result_array();
    }

    public function detail($id_powerbi)
    {
        $this->db->where('id_powerbi', $id_powerbi);
        return $this->db->get('powerbi')->row_array();
    }

    public function delete($id_powerbi)
    {
        $this->db->where('id_powerbi', $id_powerbi);
        $this->db->delete('powerbi');
    }
}
