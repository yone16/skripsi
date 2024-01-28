<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// cek sesi login
		if ($this->session->userdata('status') != "login") {
			redirect(base_url() . 'welcome?pesan=belumlogin');
		};
		$this->load->library('form_validation');
		$this->load->model('data_user');
	}

	public function index()
	{
		$user['username'] = $this->session->userdata('username');
		$user['namauser'] = $this->session->userdata('namauser');

		$data['data_user'] = $this->data_user->get_data()->result();
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('users', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	// public function add()
	// {
	// 	$info['datatype'] = 'karyawan';
	// 	$info['operation'] = 'Input';

	// 	$karyawan_id = $this->input->post('karyawan_id');
	// 	$nama_karyawan = $this->input->post('nama_karyawan');
	// 	$jeniskelamin = $this->input->post('jeniskelamin');
	// 	$alamat = $this->input->post('alamat');
	// 	$no_hp = $this->input->post('no_hp');

	// 	$aktif = 1;


	// 	$this->load->view('header');

	// 	$records = $this->data_karyawan->get_records($karyawan_id)->result();
	// 	$data = array(
	// 		'karyawan_id' => $karyawan_id,
	// 		'nama_karyawan' => $nama_karyawan,
	// 		'jeniskelamin' => $jeniskelamin,
	// 		'alamat' => $alamat,
	// 		'no_hp' => $no_hp,
	// 		'aktif' => $aktif
	// 	);
	// 	$this->data_karyawan->insert_data($data, 'karyawan');

	// 	redirect('karyawan');
	// 	$this->load->view('source');
	// }

	public function edit()
	{
		$info['datatype'] = 'users';
		$info['operation'] = 'Ubah';

		$user_id = $this->input->post('id_user');
		$namauser = $this->input->post('namauser');
		$username = $this->input->post('username');

		$this->load->view('header');

		$data = array(
			'namauser' => $namauser,
			'username' => $username
		);

		$password = $this->input->post('password');

		if (!empty($password)) {
			// Generate a random salt
			$salt = bin2hex(random_bytes(22));

			// Combine password with salt
			$salted_password = $password . $salt;

			// Hash the password using MD5 and salt
			$hashed_password = md5($salted_password);

			$data['password'] = $hashed_password;
			$data['salt'] = $salt;
		}

		$this->data_user->update_data($user_id, $data, 'user');

		redirect('users');
		$this->load->view('source');
	}


	public function delete()
	{
		$info['datatype'] = 'User';

		$id_user = $this->uri->segment('3');

		$this->load->view('header');

		$this->data_user->delete_data($id_user, 'user');

		redirect('users');
		$this->load->view('source');
	}
}
