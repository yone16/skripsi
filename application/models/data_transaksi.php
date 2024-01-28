<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_transaksi extends CI_Model
{

	public function get_data()
	{
		// $this->db->select('transaksi.*, pelanggan.*, karyawan.*, t_hargakiloan.*');
		$this->db->select('transaksi.*, pelanggan.*, pelanggan.no_hp as noHpCust, karyawan.*, t_hargakiloan.jenis as jeniskg, t_hargakiloan.harga as hargakg, t_layanan.jenis as jenislyn, t_layanan.harga as hargalyn');
		$this->db->from('transaksi');
		$this->db->join('pelanggan', 'pelanggan.pelanggan_id = transaksi.pelanggan_id');
		$this->db->join('karyawan', 'karyawan.karyawan_id = transaksi.karyawan_id');
		$this->db->join('t_hargakiloan', 't_hargakiloan.id_kilo = transaksi.layanan_kiloan');
		$this->db->join('t_layanan', 't_layanan.id_layanan = transaksi.layanan_order');
		$this->db->order_by('transaksi_id', 'desc');
		return $this->db->get();
	}

	public function get_data2()
	{
		$this->db->select('transaksi.*, pelanggan.*, pelanggan.no_hp as noHpCust, karyawan.*, t_hargasatuan.jenis as jeniskg, t_hargasatuan.harga as hargakg');
		$this->db->from('transaksi');
		$this->db->join('pelanggan', 'pelanggan.pelanggan_id = transaksi.pelanggan_id');
		$this->db->join('karyawan', 'karyawan.karyawan_id = transaksi.karyawan_id');
		$this->db->join('t_hargasatuan', 't_hargasatuan.id_satuan = transaksi.item_satuan');
		$this->db->where('transaksi.jenis_layanan', 'satuan');
		$this->db->order_by('transaksi_id', 'desc');
		return $this->db->get();
	}

	public function get_dataorder()
	{
		// $this->db->select('transaksi.*, pelanggan.*, karyawan.*, t_hargakiloan.*');
		$this->db->select('*');
		$this->db->from('t_hargakiloan');
		$this->db->order_by('id_kilo', 'desc');
		return $this->db->get();
	}

	public function get_datalayanan()
	{
		// $this->db->select('transaksi.*, pelanggan.*, karyawan.*, t_hargakiloan.*');
		$this->db->select('*');
		$this->db->from('t_layanan');
		$this->db->order_by('id_layanan', 'desc');
		return $this->db->get();
	}

	public function get_datasatuan()
	{
		// $this->db->select('transaksi.*, pelanggan.*, karyawan.*, t_hargakiloan.*');
		$this->db->select('*');
		$this->db->from('t_hargasatuan');
		$this->db->order_by('id_satuan', 'desc');
		return $this->db->get();
	}

	public function count_rows()
	{
		$now = date('Y-m-d');
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->where('tgl_order', $now);
		$num_results = $this->db->count_all_results();

		return $num_results;
	}

	public function count_active()
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->where('tgl_selesai', '0000-00-00');
		$num_results = $this->db->count_all_results();

		return $num_results;
	}

	public function get_records($where)
	{
		$this->db->where($where);
		return $this->db->get('transaksi');
	}

	public function get_full_records($where)
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('pelanggan', 'pelanggan.pelanggan_id = transaksi.pelanggan_id');
		$this->db->join('karyawan', 'karyawan.karyawan_id = transaksi.karyawan_id');
		$this->db->where($where);
		return $this->db->get();
	}

	public function filter($dari, $sampai)
	{
		return $this->db->query("select * from transaksi join karyawan on transaksi.karyawan_id = karyawan.karyawan_id join pelanggan on transaksi.pelanggan_id = pelanggan.pelanggan_id where tgl_order >= '$dari' and tgl_order <= '$sampai'");
	}

	public function insert_data($data, $table)
	{
		$this->db->insert($table, $data);
	}

	public function update_data($where, $data, $table)
	{
		$this->db->where($where);
		return $this->db->replace($table, $data);
	}

	public function update_status($where, $data, $table)
	{
		$this->db->where($where);
		return $this->db->update($table, $data);
	}

	public function delete_data($where, $table)
	{
		$this->db->where($where);
		return $this->db->delete($table);
	}

	// public function total_income_year()
	// {
	// 	$result = $this->db->query("select sum(total) as total_pendapatan from transaksi where DAY(tgl_order) = DAY(curdate())")->result();

	// 	return $result[0]->total_pendapatan;
	// }
	public function total_income_day()
	{
		$result = $this->db->query("select sum(total) as total_pendapatan from transaksi where DAY(tgl_order) = DAY(curdate()) AND MONTH(tgl_order) = MONTH(curdate()) AND YEAR(tgl_order) = YEAR(curdate())")->result();

		return $result[0]->total_pendapatan;
	}
	
	public function total_income_month()
	{
		$result = $this->db->query("select sum(total) as total_pendapatan from transaksi where MONTH(tgl_order) = MONTH(CURDATE()) AND YEAR(tgl_order) = YEAR(curdate())")->result();

		return $result[0]->total_pendapatan;
	}

	public function total_income_week()
	{
		$result = $this->db->query("select sum(total) as total_pendapatan from transaksi where WEEK(tgl_order) = WEEK(CURDATE()) AND MONTH(tgl_order) = MONTH(CURDATE()) AND YEAR(tgl_order) = YEAR(curdate())")->result();

		return $result[0]->total_pendapatan;
	}

	public function total_kiloan($idk)
	{
		$result = $this->db->query("select sum(harga) as total_harga from t_hargakiloan WHERE id_kilo = '$idk'")->result();

		return $result[0]->total_harga;
	}

	public function total_layanan($idk)
	{
		$result = $this->db->query("select sum(harga) as total_harga from t_layanan WHERE id_layanan = '$idk'")->result();

		return $result[0]->total_harga;
	}

	public function total_satuan($idk)
	{
		$result = $this->db->query("select sum(harga) as total_harga from t_hargasatuan WHERE id_satuan = '$idk'")->result();

		return $result[0]->total_harga;
	}

	public function ambilTotalOmsetByTanggal($dari, $sampai)
	{
		$result = $this->db->query("SELECT SUM(total) as total_omset FROM transaksi WHERE tgl_order >= '$dari' and tgl_order <= '$sampai'");
		return $result->result();
	}

	public function getById1($id)
	{
		$this->db->select('transaksi.*, pelanggan.*, pelanggan.no_hp as noHpCust, karyawan.*, t_hargakiloan.jenis as jeniskg, t_hargakiloan.harga as hargakg, t_layanan.jenis as jenislyn, t_layanan.harga as hargalyn');
		$this->db->from('transaksi');
		$this->db->join('pelanggan', 'pelanggan.pelanggan_id = transaksi.pelanggan_id');
		$this->db->join('karyawan', 'karyawan.karyawan_id = transaksi.karyawan_id');
		$this->db->join('t_hargakiloan', 't_hargakiloan.id_kilo = transaksi.layanan_kiloan');
		$this->db->join('t_layanan', 't_layanan.id_layanan = transaksi.layanan_order');
		$this->db->where('transaksi.transaksi_id', $id);
		$this->db->order_by('transaksi_id', 'desc');
		return $this->db->get()->row_array();
		// return $this->db->get_where('transaksi', ["transaksi_id" => $id])->row_array();
	}
	public function getById2($id)
	{
		$this->db->select('transaksi.*, pelanggan.*, pelanggan.no_hp as noHpCust, karyawan.*, t_hargasatuan.jenis as jeniskg, t_hargasatuan.harga as hargakg');
		$this->db->from('transaksi');
		$this->db->join('pelanggan', 'pelanggan.pelanggan_id = transaksi.pelanggan_id');
		$this->db->join('karyawan', 'karyawan.karyawan_id = transaksi.karyawan_id');
		$this->db->join('t_hargasatuan', 't_hargasatuan.id_satuan = transaksi.item_satuan');
		$this->db->where('transaksi.jenis_layanan', 'satuan');
		$this->db->where('transaksi.transaksi_id', $id);
		$this->db->order_by('transaksi_id', 'desc');
		return $this->db->get()->row_array();
		// return $this->db->get_where('transaksi', ["transaksi_id" => $id])->row_array();
	}
}
