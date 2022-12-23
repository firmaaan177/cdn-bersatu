<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    public function getDealer()
    {
        if($this->session->userdata('level') == '5'){
            $this->db->where('id_dealer', $this->session->userdata('id_dealer'));
        }
        $this->db->order_by('nama_dealer', 'asc');
        return $this->db->get('dealer')->result_array();
    }

    public function export_excel($year='', $id_dealer){
        if(!empty($id_dealer)){
            $this->db->where('nos_audit.id_dealer', $id_dealer);
        }
        $this->db->join('panel_sub','nos_data.id_panel_sub = panel_sub.id_panel_sub','left');
        $this->db->join('nos_audit','nos_audit.id_nos_data = nos_data.id_nos_data','left');
        $this->db->join('dealer','dealer.id_dealer = nos_audit.id_dealer','left');
        $this->db->where('YEAR(nos_audit.due_date)', $year);
        $this->db->order_by('nos_data.item','asc');
        return $this->db->get('nos_data')->result_array();
    }
}