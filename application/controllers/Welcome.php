<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('data_user');
		$this->load->library('form_validation');
	}

	function index()
	{
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('source');
	}

	function register()
	{
		$this->load->view('header');
		$this->load->view('register');
		$this->load->view('source');
	}

	function login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ($this->form_validation->run() != false) {
			$where = array(
				'username' => $username,
			);

			$user = $this->data_user->get_records($where)->row();

			if ($user) {
				// Gabungkan password yang dimasukkan dengan salt yang tersimpan
				$salted_password = $password . $user->salt;

				// Hash password yang dimasukkan dan disalted
				$hashed_password = md5($salted_password);

				if ($hashed_password === $user->password) {
					$session = array(
						'user_id' => $user->user_id,
						'username' => $user->username,
						'namauser' => $user->namauser,
						'level' => $user->level,
						'status' => 'login'
					);
					$this->session->set_userdata($session);
					redirect(base_url() . 'dashboard');
				} else {
					// Password tidak sesuai
					redirect(base_url() . 'welcome?pesan=gagal');
				}
			} else {
				// Pengguna tidak ditemukan
				redirect(base_url() . 'welcome?pesan=gagal');
			}
		} else {
			$this->load->view('login');
		}
	}


	function regis()
	{
		$fullname = $this->input->post('fullname');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$confirm_password = $this->input->post('confirm_password');

		// Validasi input formulir
		$this->form_validation->set_rules('fullname', 'Nama Lengkap', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'trim|required|matches[password]');

		if ($this->form_validation->run() != false) {
			// Generate user ID unik
			$user_id = $this->generate_user_id();

			// Generate salt acak
			$salt = bin2hex(random_bytes(22));

			// Gabungkan password dengan salt
			$salted_password = $password . $salt;

			// Hash password menggunakan MD5 dan salt
			$hashed_password = md5($salted_password);

			// Validasi formulir berhasil, sisipkan pengguna ke dalam database
			$data = array(
				'user_id' => $user_id,
				'namauser' => $fullname,
				'username' => $username,
				'password' => $hashed_password,
				'salt' => $salt,
				'level' => 'superuser',
			);

			$this->data_user->insert_record('user', $data);

			// Alihkan ke halaman login atau dasbor setelah pendaftaran berhasil
			redirect(base_url() . 'welcome?pesan=register_success');
		} else {
			// Validasi formulir gagal, arahkan kembali ke formulir pendaftaran
			redirect(base_url() . 'welcome/register?pesan=gagal_register');
		}
	}

	// Fungsi untuk menghasilkan ID pengguna yang unik
	private function generate_user_id()
	{
		// Dapatkan ID pengguna terbaru dari database
		$latest_user = $this->data_user->get_latest_user();

		// Jika ada pengguna yang sudah ada, tambahkan ID; jika tidak, mulai dari 1
		$user_id = ($latest_user) ? (int)$latest_user->user_id + 1 : 1;

		// Format ID pengguna dengan nol di depan
		$formatted_user_id = 'U' . str_pad($user_id, 3, '0', STR_PAD_LEFT);

		// Periksa apakah ID yang dihasilkan sudah ada di dalam database
		while ($this->data_user->check_user_id_exists($formatted_user_id)) {
			$user_id++;
			$formatted_user_id = 'U' . str_pad($user_id, 3, '0', STR_PAD_LEFT);
		}

		return $formatted_user_id;
	}




	function logout()
	{
		$this->session->sess_destroy();
		redirect('/');
	}
}
