<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Nos_model extends CI_Model
{
    //server side
    var $table = 'nos'; //nama tabel dari database
    var $column_order = array(null, null, 'dealer.nama_dealer','panel.nama_panel','regional.nama_regional','nos.hasil_sebelumnya','nos.status'); //field yang ada di table user
    var $column_search = array('dealer.nama_dealer','panel.nama_panel','regional.nama_regional','nos.hasil_sebelumnya','nos.status'); //field yang diizin untuk pencarian 
    var $order = array('nos.id_nos' => 'desc'); // default order

    private function get_query()
    {
        $this->db->select('*');
        $this->db->from('nos');
        // $this->db->join('menu','menu.id_menu = nos.id_menu','left');
        $this->db->join('user','user.id_user = nos.id_user','left');
        $this->db->join('dealer','dealer.id_dealer = nos.id_dealer','left');
        $this->db->join('regional','regional.id_regional = dealer.id_regional','left');
        $this->db->join('panel','panel.id_panel = dealer.id_panel','left');
        $this->db->join('nos_target','nos_target.id_nos_target = nos.id_nos_target','left');

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
            'id_dealer' => $this->input->post('id_dealer'),
            'id_user' => $this->input->post('id_user'),
            'id_nos_target' => $this->input->post('id_nos_target'),
            'hasil_sebelumnya' => $this->input->post('hasil_sebelumnya'),
            'status' => '1',
            'created_by' => $this->session->userdata('id_user'),
            'created_date' => date("Y-m-d H:i:s"),
            'edited_by' => $this->session->userdata('id_user'),
        );
        $this->db->insert('nos', $data);
        return;
    }

    public function getNosComplete($id_nos='')
    {
        if(!empty($id_nos)){
            $this->db->where('nos.id_nos', $id_nos);
        }
        // $this->db->select('nos.*');
        $this->db->join('nos_target','nos_target.id_nos_target = nos.id_nos_target','left');
        $this->db->join('dealer','dealer.id_dealer = nos.id_dealer','left');
        $this->db->join('user','user.id_user = nos.id_user','left');
        $this->db->join('user_level','user_level.id_level = user.level','left');
        $this->db->join('panel','panel.id_panel = panel.id_panel','left');
        $this->db->group_by('nos.id_nos');
        return $this->db->get('nos')->row_array();
    }

    public function getPanelSub($id_panel_sub=''){
        if(!empty($id_panel_sub)){
            $this->db->where_in('id_panel_sub', $id_panel_sub);
        }
        return $this->db->get('panel_sub');
    }

    public function getItemNosData($id_panel_sub){
        $this->db->where('id_panel_sub', $id_panel_sub);
        $this->db->order_by('item','asc');
        $this->db->group_by('item');
        return $this->db->get('nos_data')->result_array();
    }

    public function getPicNos($id_dealer='')
    {
        if(!empty($id_dealer)){
            $this->db->where('id_dealer', $id_dealer);
        }
        $this->db->where('level', SPV_NOS);
        $this->db->order_by('nama', 'desc');
        return $this->db->get('user')->result_array();
    }

    public function mot($id_dealer='', $id_panel_sub='')
    {
        if(!empty($id_dealer)){
            $this->db->where('nos_audit.id_dealer', $id_dealer);
        }
        $this->db->select('*, nos_audit.id_dealer as id_audit_dealer');
        $this->db->join('nos_data','nos_data.id_nos_data = nos_audit.id_nos_data','left');
        $this->db->join('nos_comment','nos_comment.id_nos_audit = nos_audit.id_nos_audit','left');
        $this->db->where_in('nos_data.id_panel_sub', $id_panel_sub);
        $this->db->group_by('nos_data.mot');
        return $this->db->get('nos_audit')->result_array();
    }

    public function report_nos(){
        $this->db->join('panel_sub','nos_data.id_panel_sub = panel_sub.id_panel_sub','left');
        $this->db->join('nos_audit','nos_audit.id_nos_data = nos_data.id_nos_data','left');
        $this->db->where('nos_audit.id_dealer', $this->session->userdata('id_dealer'));
        $this->db->order_by('nos_data.item','asc');
        return $this->db->get('nos_data')->result_array();
    }

    public function detail_mot($id_dealer, $mot)
    {
        if(!empty($id_dealer)){
            $this->db->where('nos_audit.id_dealer', $id_dealer);
        }
        $this->db->join('nos_data','nos_data.id_nos_data = nos_audit.id_nos_data','left');
        $this->db->where('nos_data.mot', $mot);
        return $this->db->get('nos_audit')->result_array();
    }

    public function pic_dealer()
    {
        $this->db->join('user_level','user_level.id_level = user.level','left');
        $this->db->where('user.id_dealer', $this->session->userdata('id_dealer'));
        return $this->db->get('user')->row_array();
    }


    public function detail_sub_panel($id_panel_sub)
    {
        $this->db->where('id_panel_sub', $id_panel_sub);
        return $this->db->get('panel_sub')->row_array();
    }

    public function target_nos($id_nos_target)
    {
        $this->db->where('id_nos_target', $id_nos_target);
        return $this->db->get('nos_target')->row_array();
    }

    public function item($id_panel_sub){
        $this->db->where('id_panel_sub', $id_panel_sub);
        $this->db->order_by('item','asc');
        $this->db->group_by('item');
        return $this->db->get('nos_data')->result_array();
    }

    public function sub_item($item){
        $this->db->where('item', $item);
        $this->db->order_by('sub_item_2','asc');
        $this->db->group_by('sub_item_2');
        return $this->db->get('nos_data')->result_array();
    }

    public function sub_item_detail($id_nos_data){
        $this->db->where('id_nos_data', $id_nos_data);
        return $this->db->get('nos_data')->row_array();
    }

    public function komentar_mot($id_dealer=''){
        if(!empty($id_dealer)){
            $this->db->where('nos_comment.id_dealer', $id_dealer);
        }
        $this->db->join('nos_audit','nos_audit.id_nos_audit = nos_comment.id_nos_audit','left');
        $this->db->join('nos_data','nos_data.id_nos_data = nos_audit.id_nos_data','left');
        $this->db->join('user','user.id_user = nos_comment.created_by','left');
        $this->db->join('user_level','user_level.id_level = user.level','left');
        $this->db->where('YEAR(due_date)', date('Y'));
        $this->db->where('komentar IS NOT NULL');
        $this->db->group_by('nos_comment.komentar');
        return $this->db->get('nos_comment')->result_array();
    }

    public function komentar_nos($id_nos){
        $this->db->select('*, comment.created_date as tgl_komentar');
        $this->db->join('user','user.id_user = comment.created_by','left');
        $this->db->join('user_level','user_level.id_level = user.level','left');
        $this->db->where('comment.id_nos', $id_nos);
        $this->db->order_by('comment.id_comment','desc');
        return $this->db->get('comment')->result_array();
    }

    public function insert_audit($images)
    {
        $panel_sub = $this->db->where('id_nos_data', $this->input->post('id_nos_data'))->get('nos_data')->row_array();
        $nilai = $this->input->post('nilai');
        if($nilai == 'empty'){
            $nilai = NULL;
        }
        $data = array(
            'id_nos' => $this->input->post('id_nos'),
            'id_panel_sub' => $panel_sub['id_panel_sub'],
            'id_nos_data' => $this->input->post('id_nos_data'),
            'id_dealer' => $this->input->post('id_dealer'),
            'nilai' => $nilai,
            'improve' => $this->input->post('improve'),
            'pic' => $this->input->post('pic'),
            'due_date' => $this->input->post('due_date'),
            'penjelasan' => $this->input->post('penjelasan'),
            'foto' => $images,
            'created_by' => $this->session->userdata('id_user'),
            'created_date' => date("Y-m-d H:i:s"),
            'edited_by' => $this->session->userdata('id_user'),
        );
        $this->db->insert('nos_audit', $data);
        return;
    }


    public function edit_audit($images, $id_nos_audit)
    {
        $panel_sub = $this->db->where('id_nos_data', $this->input->post('id_nos_data'))->get('nos_data')->row_array();
        $nilai = $this->input->post('nilai');
        if($nilai == 'empty'){
            $nilai = NULL;
        }
        $data = array(
            'id_nos' => $this->input->post('id_nos'),
            'id_panel_sub' => $panel_sub['id_panel_sub'],
            'id_nos_data' => $this->input->post('id_nos_data'),
            'id_dealer' => $this->session->userdata('id_dealer'),
            'nilai' => $nilai,
            'improve' => $this->input->post('improve'),
            'pic' => $this->input->post('pic'),
            'due_date' => $this->input->post('due_date'),
            'penjelasan' => $this->input->post('penjelasan'),
            'created_by' => $this->session->userdata('id_user'),
            'created_date' => date("Y-m-d H:i:s"),
            'edited_by' => $this->session->userdata('id_user'),
        );

        //cek update tanpa gambar
        (!empty($images)) ? $data = array_merge($data, ["foto" => $images]) : '';

        $this->db->where('id_nos_audit', $id_nos_audit);
        $this->db->update('nos_audit', $data);
        return;
    }

    public function checkNosByDealer($id_dealer)
    {
        if(!empty($id_dealer)){
            $this->db->where('id_dealer', $id_dealer);
        }
        return $this->db->get('nos')->row_array();
    }

    public function checkAudit($id_nos_data)
    {
        $this->db->where('id_nos_data', $id_nos_data);
        return $this->db->get('nos_audit')->row_array();
    }

    public function getAudit($id_nos_audit)
    {
        if(!empty($id_nos_audit)){
            $this->db->where('id_nos_audit', $id_nos_audit);
        }
        $this->db->where('id_nos_audit', $id_nos_audit);
        $this->db->where('YEAR(due_date)', date('Y'));
        return $this->db->get('nos_audit')->row_array();
    }

    public function persentaseTotalNos(){

    }

    public function insert_perbaikan($images)
    {
        $data = array(
            'id_nos_audit' => $this->input->post('id_nos_audit'),
            'status' => 'pending',
            'id_dealer' => $this->session->userdata('id_dealer'),
            'foto' => $images,
            'created_by' => $this->session->userdata('id_user'),
            'created_date' => date("Y-m-d H:i:s"),
            'edited_by' => $this->session->userdata('id_user'),
        );
        $this->db->insert('nos_perbaikan', $data);
        return;
    }

    public function is_perbaikan()
    {
        $data = array(
            'is_perbaikan' => 2
        );
        $this->db->where('id_nos_audit', $this->input->post('id_nos_audit'));
        $this->db->update('nos_audit', $data);
        return;
    }

    public function approve()
    {
        $check = $this->db->where('id_nos_audit', $this->input->post('id_nos_audit'))->get('nos_audit')->row_array();
        if($check['is_perbaikan'] == 1){
            $nilai = 1;
        }else{
            $nilai = $check['nilai'];
        }
        $data = array(
            'nilai' => $nilai,
            'status' => $this->input->post('status'),
            'is_perbaikan' => $this->input->post('is_perbaikan'),
            'edited_date' => date("Y-m-d H:i:s"),
            'edited_by' => $this->session->userdata('id_user'),
        );
        $this->db->where('id_nos_audit', $this->input->post('id_nos_audit'));
        $this->db->update('nos_audit', $data);
        return;
    }

    public function approve_perbaikan()
    {
        $data = array(
            'status' => 'approve',
            'edited_date' => date("Y-m-d H:i:s"),
            'edited_by' => $this->session->userdata('id_user'),
        );
        $this->db->where('id_nos_audit', $this->input->post('id_nos_audit'));
        $this->db->update('nos_perbaikan', $data);
        return;
    }

    public function approve_by_mot()
    {
        $nos_data = $this->db->where('mot', $this->input->post('mot'))->get('nos_data')->result_array();
        $data = array();
        foreach ($nos_data as $row) {
            $data[] = array(
                'id_nos_data' => $row['id_nos_data'],
                'status' => $this->input->post('status'),
                'is_perbaikan' => $this->input->post('is_perbaikan'),
                'edited_date' => date("Y-m-d H:i:s"),
                'edited_by' => $this->session->userdata('id_user'),
            );
        }
        $this->db->where('id_dealer', $this->session->userdata('id_dealer'));
        $this->db->where('YEAR(due_date)', date('Y'));
        $this->db->update_batch('nos_audit', $data, 'id_nos_data');
        return;
    }

    public function lock_nos($id_dealer='')
    {
        $nos_data = $this->db->where('mot', $this->input->post('mot'))->get('nos_data')->result_array();
        $data = array();
        foreach ($nos_data as $row) {
            $data[] = array(
                'id_nos_data' => $row['id_nos_data'],
                'is_lock' => $this->input->post('is_lock'),
                'edited_date' => date("Y-m-d H:i:s"),
                'edited_by' => $this->session->userdata('id_user'),
            );
        }
        if(!empty($id_dealer)){
            $this->db->where('id_dealer', $id_dealer);
        }
        $this->db->where('YEAR(due_date)', date('Y'));
        $this->db->update_batch('nos_audit', $data, 'id_nos_data');
        return;
    }

    public function nos_by_mot($id_dealer, $mot){
        $this->db->join('nos_data','nos_data.id_nos_data = nos_audit.id_nos_data','left');
        $this->db->where('nos_data.mot', $mot);
        $this->db->where('nos_audit.id_dealer', $id_dealer);
        return $this->db->get('nos_audit')->result_array();
    }

    public function add_comment()
    {
        $nos_data = $this->nos_by_mot($this->input->post('id_dealer'), $this->input->post('mot'));
        $data = array();
        foreach ($nos_data as $row) {
            $data[] = array(
                'id_nos_audit' => $row['id_nos_audit'],
                'id_dealer' => $this->input->post('id_dealer'),
                'komentar' => $this->input->post('komentar'),
                'created_by' => $this->session->userdata('id_user'),
                'created_date' => date("Y-m-d H:i:s"),
                'edited_by' => $this->session->userdata('id_user'),
            );
        }
        $this->db->insert_batch('nos_comment', $data, 'id_nos_data');
        return;
    }

    public function add_comment_nos()
    {
        $data = array(
            'id_nos' => $this->input->post('id_nos'),
            'komentar' => $this->input->post('komentar'),
            'created_by' => $this->session->userdata('id_user'),
            'created_date' => date("Y-m-d H:i:s"),
            'edited_by' => $this->session->userdata('id_user'),
        );
        $this->db->insert('comment', $data);
        return;
    }

    public function perbaikan()
    {
        $data = array(
            'status' => $this->input->post('status'),
            'is_perbaikan' => $this->input->post('is_perbaikan'),
            'edited_date' => date("Y-m-d H:i:s"),
            'edited_by' => $this->session->userdata('id_user'),
        );
        $this->db->where('id_nos_audit', $this->input->post('id_nos_audit'));
        $this->db->update('nos_audit', $data);
        return;
    }

    public function import_excel($data){
		$insert = $this->db->insert_batch('tbl_data2', $data);
		if($insert){
			return true;
		}
	}

    public function getData(){
		$this->db->select('*');
		return $this->db->get('tbl_data2')->result_array();
	}
}