<?php

class M_customer extends CI_Model
{
	protected $_table = 'tb_customer';

	public function lihat()
	{
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function jumlah()
	{
		$query = $this->db->get($this->_table);
		return $query->num_rows();
	}

	public function lihat_id($id_customer)
	{
		$query = $this->db->get_where($this->_table, ['id_customer' => $id_customer]);
		return $query->row();
	}

	public function lihat_email($email)
	{
		$query = $this->db->get_where($this->_table, ['email' => $email]);
		return $query->row();
	}

	public function tambah($data)
	{
		return $this->db->insert($this->_table, $data);
	}

	public function ubah($data, $id_customer)
	{
		$query = $this->db->set($data);
		$query = $this->db->where(['id_customer' => $id_customer]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($id_customer)
	{
		return $this->db->delete($this->_table, ['id_customer' => $id_customer]);
	}
}
