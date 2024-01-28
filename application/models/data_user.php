<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_user extends CI_Model
{

	public function get_data()
	{
		return $this->db->get('user');
	}

	public function get_records($where)
	{
		$this->db->where($where);
		return $this->db->get('user');
	}

	public function update_data($user_id, $data, $table)
	{
		$where = array('user_id' => $user_id);
		$this->db->where($where);
		return $this->db->update($table, $data);
	}

	public function check_user_id_exists($user_id)
    {
        $this->db->select('user_id');
        $this->db->from('user');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();

        return $query->num_rows() > 0;
    }

	public function get_latest_user()
    {
        $this->db->select('user_id');
        $this->db->from('user');
        $this->db->order_by('user_id', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get();

        return $query->row(); // Return the result as an object
    }

	public function insert_record($table, $data)
	{
		$this->db->insert($table, $data);
	}

	public function delete_data($user_id, $table){
		$where = array('user_id' => $user_id);
		$this->db->where($where);
		return $this->db->delete($table);
	}
}
