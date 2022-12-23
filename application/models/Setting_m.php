<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting_m extends CI_Model
{

    public function dataSetting()
    {
        $id_setting = $this->session->userdata('id_setting');
        $query = $this->db->query("SELECT * FROM setting where id_setting = '$id_setting'");
        return $query->row();
    }

    public function edit($nama_gambar, $id)
    {
        $data = [
            "nama_website" => $this->input->post('nama_website'),
            "alamat" => $this->input->post('alamat'),
            "email" => $this->input->post('email'),
            "telepon" => $this->input->post('telepon'),
            "website" => $this->input->post('website'),
            "tentang" => $this->input->post('tentang'),
            "maps" => $this->input->post('maps'),
            "edited" => date("Y-m-d H:i:s"),
        ];

        //cek update tanpa gambar
        (!empty($nama_gambar)) ? $data = array_merge($data, ["logo" => $nama_gambar]) : '';

        $this->db->where('id_setting', $id);
        $this->db->update('setting', $data);
        return ($this->db->affected_rows() != 1) ? false : true;
    }
}
