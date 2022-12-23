<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{


    function __construct()
    {
        parent::__construct();
    }

    public function artikel()
    {   
        return $this->db->get('artikel')->num_rows();
    }

    public function log_login()
    {
        $this->db->order_by('id_log_login', 'desc');
        $this->db->limit(20);
        return $this->db->get('log_login')->result_array();
    }

    public function komentar()
    {
        return $this->db->get('komentar')->num_rows();
    }

    public function grafik_visitor()
    {
        $qry = $this->db->query("SELECT created, visitor FROM `visitor`  WHERE YEAR(created) = YEAR(CURDATE())");
        return  $qry->result_array();
    }
}
