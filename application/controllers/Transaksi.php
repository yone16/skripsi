<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		// cek sesi login
		if ($this->session->userdata('status') != "login") {
			redirect(base_url() . 'welcome?pesan=belumlogin');
		};
		$this->load->library('form_validation');
		$this->load->model('data_transaksi');
		$this->load->model('data_pelanggan');
		$this->load->model('data_karyawan');
		$this->load->model('data_setting');
	}

	public function index()
	{
		$user['username'] = $this->session->userdata('username');
		$user['namauser'] = $this->session->userdata('namauser');

		$data['data_transaksi'] = $this->data_transaksi->get_data()->result();
		$data['data_transaksi2'] = $this->data_transaksi->get_data2()->result();
		$data['data_pelanggan'] = $this->data_pelanggan->get_data()->result();
		$data['data_karyawan'] = $this->data_karyawan->get_data()->result();
		$data['dataorder'] = $this->data_transaksi->get_dataorder()->result();
		$data['datalayanan'] = $this->data_transaksi->get_datalayanan()->result();
		$data['datasatuan'] = $this->data_transaksi->get_datasatuan()->result();
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('transaksi', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function tambahKiloan()
	{
		$user['username'] = $this->session->userdata('username');
		$user['namauser'] = $this->session->userdata('namauser');

		$data['data_transaksi'] = $this->data_transaksi->get_data()->result();
		$data['data_pelanggan'] = $this->data_pelanggan->get_data()->result();
		$data['data_karyawan'] = $this->data_karyawan->get_data()->result();
		$data['layanan'] = $this->data_setting->get_data3()->result();
		$data['order'] = $this->data_setting->get_data()->result();
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('tambahKiloan', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function tambahSatuan()
	{
		$user['username'] = $this->session->userdata('username');
		$user['namauser'] = $this->session->userdata('namauser');

		$data['data_transaksi2'] = $this->data_transaksi->get_data2()->result();
		$data['data_pelanggan'] = $this->data_pelanggan->get_data()->result();
		$data['data_karyawan'] = $this->data_karyawan->get_data()->result();
		$data['layanan'] = $this->data_setting->get_data3()->result();
		$data['order'] = $this->data_setting->get_data()->result();
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('tambahSatuan', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function print()
	{
		$id = $this->uri->segment('3');
		$mpdf = new \Mpdf\Mpdf();
		$data['detail'] = $this->data_transaksi->getById1($id);
		// $data['orders'] = $this->data_transaksi->get_detail($id)->result();
		// $data['total'] = $this->data_transaksi->total_print($id)->result();
		$html = $this->load->view('print/print', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	public function print2()
	{
		$id = $this->uri->segment('3');
		$mpdf = new \Mpdf\Mpdf();
		$data['detail'] = $this->data_transaksi->getById1($id);
		// $data['orders'] = $this->data_transaksi->get_detail($id)->result();
		// $data['total'] = $this->data_transaksi->total_print($id)->result();
		$html = $this->load->view('print/print2', $data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}

	public function add()
	{
		$info['datatype'] = 'transaksi';
		$info['operation'] = 'Input';

		$pelanggan_id = $this->input->post('pelanggan_id');
		$karyawan_id = $this->input->post('karyawan_id');
		$berat = $this->input->post('berat');
		$diskon = $this->input->post('diskon');
		$tgl_order = $this->input->post('tgl_order');
		$tgl_selesai = $this->input->post('tgl_selesai');
		$tipecuci = $this->input->post('tipecuci');
		$jenislayanan = $this->input->post('jenislayanan');
		$tipe = $this->input->post('tipe');

		date_default_timezone_set("Asia/Jakarta");
		$transaksi_id = date('YmdHis');

		$order = $this->data_transaksi->total_kiloan($tipecuci);
		$layanan = $this->data_transaksi->total_layanan($jenislayanan);

		$potongan_diskon = ($berat * $order * $layanan) * ($diskon / 100);
		$total = ($berat * $order * $layanan) - $potongan_diskon;

		$this->load->view('header');

		$where = array(
			'transaksi_id' => $transaksi_id
		);
		$records = $this->data_transaksi->get_records($where)->result();

		$data = array(
			'transaksi_id' => $transaksi_id,
			'pelanggan_id' => $pelanggan_id,
			'karyawan_id' => $karyawan_id,
			'berat' => $berat,
			'diskon' => $diskon,
			'total' => $total,
			'tgl_order' => $tgl_order,
			'tgl_selesai' => $tgl_selesai,
			'jenis_layanan' => $tipe,
			'layanan_order' => $jenislayanan,
			'layanan_kiloan' => $tipecuci,
			'item_satuan' => NULL,
			'status' => 'menunggu'
		);
		$this->data_transaksi->insert_data($data, 'transaksi');

		redirect('transaksi');
		$this->load->view('source');
	}

	public function add2()
	{
		$info['datatype'] = 'transaksi';
		$info['operation'] = 'Input';

		$pelanggan_id = $this->input->post('pelanggan_id');
		$karyawan_id = $this->input->post('karyawan_id');
		$berat = $this->input->post('berat');
		$diskon = $this->input->post('diskon');
		$tgl_order = $this->input->post('tgl_order');
		$tgl_selesai = $this->input->post('tgl_selesai');
		$tipe = $this->input->post('tttt');
		$satuan = $this->input->post('satuan');


		date_default_timezone_set("Asia/Jakarta");
		$transaksi_id = date('YmdHis');

		$totalsatuan = $this->data_transaksi->total_satuan($satuan);

		// $total = $totalsatuan;

		$potongan_diskon = ($totalsatuan) * ($diskon / 100);
		$total = $totalsatuan - $potongan_diskon;

		$this->load->view('header');

		$where = array(
			'transaksi_id' => $transaksi_id
		);
		$records = $this->data_transaksi->get_records($where)->result();

		$data = array(
			'transaksi_id' => $transaksi_id,
			'pelanggan_id' => $pelanggan_id,
			'karyawan_id' => $karyawan_id,
			'berat' => $berat,
			'diskon' => $diskon,
			'total' => $total,
			'tgl_order' => $tgl_order,
			'tgl_selesai' => $tgl_selesai,
			'jenis_layanan' => $tipe,
			'item_satuan' => $satuan,
			'layanan_order' => NULL,
			'layanan_kiloan' => NULL
		);
		$this->data_transaksi->insert_data($data, 'transaksi');

		redirect('transaksi');
		$this->load->view('source');
	}

	public function status()
	{
		$info['datatype'] = 'transaksi';
		$info['operation'] = 'Ubah';

		$transaksi_id = $this->input->post('transaksi_id');
		$status = $this->input->post('status');

		$this->load->view('header');

		$where = array(
			'transaksi_id' => $transaksi_id
		);
		$data = array(
			'status' => $status
		);
		$this->data_transaksi->update_status($where, $data, 'transaksi');


		redirect('transaksi');
		$this->load->view('source');
	}

	public function edit()
	{
		$info['datatype'] = 'transaksi';
		$info['operation'] = 'Ubah';

		$transaksi_id = $this->input->post('transaksi_id');
		$pelanggan_id = $this->input->post('pelanggan_id');
		$karyawan_id = $this->input->post('karyawan_id');
		$berat = $this->input->post('berat');
		$tgl_order = $this->input->post('tgl_order');
		$tgl_selesai = $this->input->post('tgl_selesai');
		$tipecuci = $this->input->post('tipecuci');
		$jenislayanan = $this->input->post('jenislayanan');
		$tipe = $this->input->post('tipe');
		$status = $this->input->post('status');

		$order = $this->data_transaksi->total_kiloan($tipecuci);
		$layanan = $this->data_transaksi->total_layanan($jenislayanan);

		$total = ($berat * $order) * $layanan;

		$this->load->view('header');

		$where = array(
			'transaksi_id' => $transaksi_id
		);
		$data = array(
			'transaksi_id' => $transaksi_id,
			'pelanggan_id' => $pelanggan_id,
			'karyawan_id' => $karyawan_id,
			'berat' => $berat,
			'total' => $total,
			'layanan_order' => $jenislayanan,
			'layanan_kiloan' => $tipecuci,
			'jenis_layanan' => $tipe,
			'tgl_order' => $tgl_order,
			'tgl_selesai' => $tgl_selesai,
			'status' => $status
		);
		$this->data_transaksi->update_data($where, $data, 'transaksi');


		redirect('transaksi');
		$this->load->view('source');
	}


	public function edit2()
	{
		$info['datatype'] = 'transaksi';
		$info['operation'] = 'Ubah';

		$transaksi_id = $this->input->post('transaksi_id');
		$pelanggan_id = $this->input->post('pelanggan_id');
		$karyawan_id = $this->input->post('karyawan_id');
		$berat = $this->input->post('berat');
		$tgl_order = $this->input->post('tgl_order');
		$tgl_selesai = $this->input->post('tgl_selesai');
		$tipe = $this->input->post('tttt');
		$satuan = $this->input->post('satuan');

		$totalsatuan = $this->data_transaksi->total_satuan($satuan);

		$total = $totalsatuan;

		$this->load->view('header');

		$where = array(
			'transaksi_id' => $transaksi_id
		);
		$data = array(
			'transaksi_id' => $transaksi_id,
			'pelanggan_id' => $pelanggan_id,
			'karyawan_id' => $karyawan_id,
			'berat' => $berat,
			'total' => $total,
			'item_satuan' => $satuan,
			'jenis_layanan' => $tipe,
			'tgl_order' => $tgl_order,
			'tgl_selesai' => $tgl_selesai,
			'layanan_order' => NULL,
			'layanan_kiloan' => NULL
		);
		$this->data_transaksi->update_data($where, $data, 'transaksi');


		redirect('transaksi');
		$this->load->view('source');
	}

	public function done()
	{
		$info['datatype'] = 'transaksi';
		$info['operation'] = 'Ubah';

		$transaksi_id = $this->uri->segment('3');
		$tgl_selesai = date('Y-m-d'); //Tambahkan tgl selesai order

		$this->db->query("update transaksi set tgl_selesai = '$tgl_selesai' where transaksi_id = '$transaksi_id'");

		redirect('transaksi');
		$this->load->view('source');
	}

	public function delete()
	{
		$info['datatype'] = 'transaksi';

		$transaksi_id = $this->uri->segment('3');

		$where = array(
			'transaksi_id' => $transaksi_id
		);

		$this->load->view('header');

		$this->data_transaksi->delete_data($where, 'transaksi');

		redirect('transaksi');
		$this->load->view('source');
	}

	public function laporan()
	{

		$user['username'] = $this->session->userdata('username');
        $user['namauser'] = $this->session->userdata('namauser');

		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('laporan/laporan_filter_transaksi');
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function laporan_filter()
	{
		$user['username'] = $this->session->userdata('username');

		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');

		$data['data_transaksi'] = $this->data_transaksi->filter($dari, $sampai)->result();
		$data['omset'] = $this->data_transaksi->ambilTotalOmsetByTanggal($dari, $sampai);

		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('laporan/laporan_transaksi', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	// function print()
	// {

	// 	$dari = $this->uri->segment('3');
	// 	$sampai = $this->uri->segment('4');

	// 	$data['dari'] = $dari;
	// 	$data['sampai'] = $sampai;
	// 	$data['data_transaksi'] = $this->data_transaksi->filter($dari, $sampai)->result();

	// 	$this->load->view('print/transaksi', $data);
	// }

	function print_nota()
	{

		$transaksi_id = $this->uri->segment('3');

		$where = array(
			'transaksi_id' => $transaksi_id
		);
		$data['data_transaksi'] = $this->data_transaksi->get_full_records($where)->result();

		$this->load->view('print/nota_transaksi', $data);
	}

	function cetak_pdf()
	{
		$this->load->library('dompdf_gen');

		$dari = $this->uri->segment('3');
		$sampai = $this->uri->segment('4');

		$data['dari'] = $dari;
		$data['sampai'] = $sampai;
		$data['data_transaksi'] = $this->data_transaksi->filter($dari, $sampai)->result();

		$this->load->view('pdf/transaksi', $data);

		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Transaction_Detail.pdf", array('Attachment' => 0));
	}
}
