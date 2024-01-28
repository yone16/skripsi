<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// cek sesi login
		if ($this->session->userdata('status') != "login") {
			redirect(base_url() . 'welcome?pesan=belumlogin');
		}
		$this->load->model('data_karyawan');
		$this->load->model('data_pelanggan');
		$this->load->model('data_transaksi');
	}

	public function index()
	{
		$user['username'] = $this->session->userdata('username');
		$user['namauser'] = $this->session->userdata('namauser');

		$total_pendapatan = $this->data_transaksi->total_income_day();
		$total_month = $this->data_transaksi->total_income_month();
		$total_week = $this->data_transaksi->total_income_week();

		$data = array(
			'n_transaksi' => $this->data_transaksi->count_rows(),
			'total_pendapatan' => $total_pendapatan,
			'total_bulan' => $total_month,
			'total_minggu' => $total_week
		);
		// $data = array(
		// 	'n_karyawan' => $this->data_karyawan->count_rows(),
		// 	'n_pelanggan' => $this->data_pelanggan->count_rows(),
		// 	'n_transaksi' => $this->data_transaksi->count_rows(),
		// 	'n_transaksi_aktif' => $this->data_transaksi->count_active(),
		// 	'total_pendapatan' => $total_pendapatan
		// );

		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('dashboard', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}
}
