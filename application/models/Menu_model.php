<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menu_model extends CI_Model
{

    public function getmenu()
    {
        $this->db->order_by('id_regional', 'asc');
        return $this->db->get('menu')->result_array();
    }

}