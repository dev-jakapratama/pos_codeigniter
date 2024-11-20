<?php

use Dompdf\Dompdf;

class Makanan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if($this->session->login['role'] != 'kasir' && $this->session->login['role'] != 'admin') redirect();
        $this->data['aktif'] = 'makanan';
        $this->load->model('M_makanan', 'm_makanan');
    }

    public function index() {
        $this->data['title'] = 'Data Makanan';
        $this->data['all_food'] = $this->m_makanan->get_all_makanan();
        $this->data['no'] = 1;
        $this->load->view('makanan/index', $this->data);
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

    public function ubah($id){
		if ($this->session->login['role'] == 'kasir'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('makanan');
		}

		$this->data['title'] = 'Ubah Makanan';
        $this->data['makanan'] = $this->m_makanan->lihat_id($id);

        // Lanjutkan jika data ditemukan
        if ($this->data['makanan']) {
                $this->load->view('makanan/ubah', $this->data);
        } else {
                $this->session->set_flashdata('error', 'Data Makanan tidak ditemukan!');
                redirect('makanan');
        }
	}

	public function proses_ubah($id){
		if ($this->session->login['role'] == 'kasir'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk admin!');
			redirect('makanan');
		}

		$data = [
			'nama' => $this->input->post('nama'),
			'harga' => $this->input->post('harga'),
			'stock' => $this->input->post('stock')
		];
		if($this->m_makanan->ubah($data, $id)){
			$this->session->set_flashdata('success', 'Data Makanan <strong>Berhasil</strong> Diubah!');
			redirect('makanan');
		} else {
			$this->session->set_flashdata('error', 'Data Makanan <strong>Gagal</strong> Diubah!');
			redirect('makanan');
		}
	}

    public function hapus($nama){
		if ($this->session->login['role'] == 'kasir'){
			$this->session->set_flashdata('error', 'Hapus data hanya untuk admin!');
			redirect('makanan');
		}
		
		if($this->m_makanan->hapus($nama)){
			$this->session->set_flashdata('success', 'Data Makanan <strong>Berhasil</strong> Dihapus!');
			redirect('makanan');
		} else {
			$this->session->set_flashdata('error', 'Data Makanan <strong>Gagal</strong> Dihapus!');
			redirect('makanan');
		}
	}
}
