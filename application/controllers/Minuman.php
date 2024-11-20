<?php

use Dompdf\Dompdf;

class Minuman extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
        $this->data['aktif'] = 'minuman';
        $this->load->model('M_minuman', 'm_makanan');
    }

    public function index() {
        $this->data['title'] = 'Data Minuman';
        $this->data['minuman'] = $this->m_minuman->get_all_minuman();
        $this->data['no'] = 1;
        $this->load->view('minuman/index', $this->data);
    }

    public function add() {
        $this->data['title'] = 'Tambah Makanan';
        $this->load->view('makanan/add', $this->data);
    }

    public function process_add() {
        if ($this->session->login['role'] == 'kasir'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk admin!');
			redirect('penjualan');
		}

		$data = [
			'nama' => $this->input->post('nama'),
			'harga' => $this->input->post('harga'),
			'stock' => $this->input->post('stock')
		];

		if($this->m_makanan->create_data($data)){
			$this->session->set_flashdata('success', 'Data Makanan <strong>Berhasil</strong> Ditambahkan!');
			redirect('makanan');
		} else {
			$this->session->set_flashdata('error', 'Data Makanan <strong>Gagal</strong> Ditambahkan!');
			redirect('makanan');
		}

    }

    public function edit($id) {
        $data['makanan'] = $this->Makanan->get_makanan_by_id($id);
        if ($this->input->post()) {
            $update_data = array(
                'nama' => $this->input->post('nama'),
                'harga' => $this->input->post('harga'),
                'stock' => $this->input->post('stock')
            );
            $this->Makanan->update_makanan($id, $update_data);
            redirect('makanan');
        }
        $this->load->view('makanan/edit', $data);
    }

    public function delete($id) {
        $this->Makanan->delete_makanan($id);
        redirect('makanan');
    }
}
