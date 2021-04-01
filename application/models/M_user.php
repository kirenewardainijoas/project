<?php

class M_user extends CI_Model{
	protected $_table = 'tb_user';

	public function lihat(){
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function jumlah(){
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_id($id_user){
		$query = $this->db->get_where($this->_table, ['id_user' => $id_user]);
		return $query->row();
	}

	public function lihat_email($email){
		$query = $this->db->get_where($this->_table, ['email' => $email]);
		return $query->row();
	}

	public function tambah($data){
		return $this->db->insert($this->_table, $data);
	}

	public function ubah($data, $id_user){
		$query = $this->db->set($data);
		$query = $this->db->where(['id_user' => $id_user]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($id_user){
		return $this->db->delete($this->_table, ['id_user' => $id_user]);
	}
}