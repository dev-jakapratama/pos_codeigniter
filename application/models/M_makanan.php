<?php

class M_Makanan extends CI_Model {
    protected $_table = 'makanan';

    public function get_all_makanan() {
        $query = $this->db->get($this->_table);
        return $query->result();
    }

    public function create_data($data) {
        return $this->db->insert($this->_table, $data);
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

    public function lihat_id($id){
		$query = $this->db->get_where($this->_table, ['id' => $id]);
		return $query->row();
	}

    public function ubah($data, $nama){
		$query = $this->db->set($data);
		$query = $this->db->where(['nama' => $nama]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($nama){
		return $this->db->delete($this->_table, ['nama' => $nama]);
	}
}
