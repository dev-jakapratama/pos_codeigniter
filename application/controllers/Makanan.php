<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use Dompdf\Dompdf;

class Makanan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->data['aktif'] = 'makanan';
        $this->load->model('M_makanan', 'm_makanan');
    }

    public function index() {
        $this->data['title'] = 'Data Makanan';
        $this->data['makanan'] = $this->m_makanan->get_all_makanan();
        $this->data['no'] = 1;
        $this->load->view('makanan/index', $this->data);
    }

    public function create() {
        if ($this->input->post()) {
            $data = array(
                'nama' => $this->input->post('nama'),
                'harga' => $this->input->post('harga'),
                'stock' => $this->input->post('stock')
            );
            $this->Makanan->insert_makanan($data);
            redirect('makanan');
        }
        $this->load->view('makanan/create');
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
