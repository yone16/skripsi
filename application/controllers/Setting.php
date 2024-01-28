<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        // cek sesi login
        if ($this->session->userdata('status') != "login") {
            redirect(base_url() . 'welcome?pesan=belumlogin');
        };
        $this->load->library('form_validation');
        $this->load->model('data_setting');
    }

    public function index()
    {
        redirect('setting/kiloan');
    }

    public function kiloan()
    {
        $user['username'] = $this->session->userdata('username');
        $user['namauser'] = $this->session->userdata('namauser');
        
        $data['data_setting'] = $this->data_setting->get_data()->result();
        $this->load->view('header');
        $this->load->view('navigation', $user);
        $this->load->view('setting', $data);
        $this->load->view('footer');
        $this->load->view('source');
    }

    public function satuan()
    {
        $user['username'] = $this->session->userdata('username');
        $user['namauser'] = $this->session->userdata('namauser');
        
        $data['data_setting'] = $this->data_setting->get_data2()->result();
        $this->load->view('header');
        $this->load->view('navigation', $user);
        $this->load->view('satuan', $data);
        $this->load->view('footer');
        $this->load->view('source');
    }

    public function layanan()
    {
        $user['username'] = $this->session->userdata('username');
        $user['namauser'] = $this->session->userdata('namauser');
        
        $data['data_setting'] = $this->data_setting->get_data3()->result();
        $this->load->view('header');
        $this->load->view('navigation', $user);
        $this->load->view('layanan', $data);
        $this->load->view('footer');
        $this->load->view('source');
    }

    public function edit()
    {

        $id_kilo = $this->input->post('id');
        $harga = $this->input->post('harga');
        $jenis = $this->input->post('jenis');

        $this->load->view('header');

        $data = array(
            'id_kilo' => $id_kilo,
            'harga' => $harga,
            'jenis' => $jenis
        );
        $this->data_setting->update_data($id_kilo, $data, 't_hargakiloan');

        redirect('setting/kiloan');
        $this->load->view('source');
    }

    public function editSatuan()
    {

        $id_satuan = $this->input->post('id');
        $jenis = $this->input->post('jenis');
        $harga = $this->input->post('harga');

        $this->load->view('header');

        $data = array(
            'id_satuan' => $id_satuan,
            'jenis' => $jenis,
            'harga' => $harga
        );
        $this->data_setting->update_data2($id_satuan, $data, 't_hargasatuan');

        redirect('setting/satuan');
        $this->load->view('source');
    }

    public function tambah_satuan()
    {

        $id_satuan = $this->input->post('id');
        $jenis = $this->input->post('jenis');
        $harga = $this->input->post('harga');

        $data = array();

        $this->load->view('header');

        $index = 0;
        foreach ($id_satuan as $idsatuan) {
            array_push($data, array(
                'id_satuan' => $idsatuan,
                'jenis' => $jenis[$index],
                'harga' => $harga[$index],
            ));

            $index++;
        }

        $this->data_setting->update_data($data, 't_hargasatuan');

        redirect('setting/satuan');
        $this->load->view('source');
    }

    public function tambahSatuan()
    {

        // $id_satuan = $this->input->post('id');
        $jenis = $this->input->post('jenis');
        $harga = $this->input->post('harga');


        $this->load->view('header');

        $data = array(
            'jenis' => $jenis,
            'harga' => $harga
        );


        $this->data_setting->insert_satuan($data, 't_hargasatuan');

        redirect('setting/satuan');
        $this->load->view('source');
    }
    
    public function tambahKiloan()
    {

        // $id_satuan = $this->input->post('id');
        $jenis = $this->input->post('jenis');
        $harga = $this->input->post('harga');


        $this->load->view('header');

        $data = array(
            'jenis' => $jenis,
            'harga' => $harga
        );


        $this->data_setting->insert_satuan($data, 't_hargakiloan');

        redirect('setting/kiloan');
        $this->load->view('source');
    }

    public function delete()
    {

        $id_satuan = $this->uri->segment('3');

        $this->load->view('header');

        $this->data_setting->delete_data($id_satuan, 't_hargasatuan');

        redirect('setting/satuan');
        $this->load->view('source');
    }

    public function deleteKilo()
    {

        $id_kilo = $this->uri->segment('3');

        $this->load->view('header');

        $this->data_setting->delete_kilo($id_kilo, 't_hargakiloan');

        redirect('setting/kiloan');
        $this->load->view('source');
    }

    public function tambahLayanan()
    {

        // $id_satuan = $this->input->post('id');
        $jenis = $this->input->post('jenis');
        $harga = $this->input->post('harga');


        $this->load->view('header');

        $data = array(
            'jenis' => $jenis,
            'harga' => $harga
        );


        $this->data_setting->insert_data($data, 't_layanan');

        redirect('setting/layanan');
        $this->load->view('source');
    }

    public function deleteLayanan()
    {

        $id_layanan = $this->uri->segment('3');

        $this->load->view('header');

        $this->data_setting->delete_layanan($id_layanan, 't_layanan');

        redirect('setting/layanan');
        $this->load->view('source');
    }

    public function editLayanan()
    {

        $id_layanan = $this->input->post('id');
        $jenis = $this->input->post('jenis');
        $harga = $this->input->post('harga');

        $this->load->view('header');

        $data = array(
            'id_layanan' => $id_layanan,
            'jenis' => $jenis,
            'harga' => $harga
        );
        $this->data_setting->update_data3($id_layanan, $data, 't_layanan');

        redirect('setting/layanan');
        $this->load->view('source');
    }
}
