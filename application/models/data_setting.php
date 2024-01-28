<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_setting extends CI_Model
{

    public function get_data()
    {
        $this->db->select('*');
        $this->db->from('t_hargakiloan');
        $this->db->order_by('id_kilo', 'desc');
        return $this->db->get();
    }

    public function get_data2()
    {
        $this->db->select('*');
        $this->db->from('t_hargasatuan');
        $this->db->order_by('id_satuan', 'desc');
        return $this->db->get();
    }

    public function get_data3()
    {
        $this->db->select('*');
        $this->db->from('t_layanan');
        $this->db->order_by('id_layanan', 'desc');
        return $this->db->get();
    }

    public function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function insert_satuan($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function update_data($id_kilo, $data, $table)
    {
        $where = array('id_kilo' => $id_kilo);
        $this->db->where($where);
        return $this->db->update($table, $data);
    }

    public function update_data2($id_satuan, $data, $table)
    {
        $where = array('id_satuan' => $id_satuan);
        $this->db->where($where);
        return $this->db->update($table, $data);
    }

    public function update_data3($id_layanan, $data, $table)
    {
        $where = array('id_layanan' => $id_layanan);
        $this->db->where($where);
        return $this->db->update($table, $data);
    }

    public function delete_data($id_satuan, $table)
    {
        $where = array('id_satuan' => $id_satuan);
        $this->db->where($where);
        return $this->db->delete($table);
    }

    public function delete_kilo($id_kilo, $table)
    {
        $where = array('id_kilo' => $id_kilo);
        $this->db->where($where);
        return $this->db->delete($table);
    }

    public function delete_layanan($id_layanan, $table)
    {
        $where = array('id_layanan' => $id_layanan);
        $this->db->where($where);
        return $this->db->delete($table);
    }
}
