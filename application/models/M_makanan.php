<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Makanan extends CI_Model {
    protected $_table = 'makanan';

    public function get_all_makanan() {
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function insert_makanan($data) {
        return $this->db->insert('makanan', $data);
    }

    public function get_makanan_by_id($id) {
        return $this->db->get_where('makanan', array('id' => $id))->row();
    }

    public function update_makanan($id, $data) {
        return $this->db->where('id', $id)->update('makanan', $data);
    }

    public function delete_makanan($id) {
        return $this->db->where('id', $id)->delete('makanan');
    }
}
