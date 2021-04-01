<?php

class M_jawaban extends CI_Model {
	protected $_table = 'tb_jawaban';

	public function lihat(){
		return $this->db->get($this->_table)->result();
	} 

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_id_jawaban($id_jawaban){
		return $this->db->get_where($this->_table, ['id_jawaban' => $id_jawaban])->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function hapus($id_jawaban){
		return $this->db->delete($this->_table, ['id_jawaban' => $id_jawaban]);
	}
}