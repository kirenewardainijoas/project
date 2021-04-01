<?php

class M_survei extends CI_Model
{
	protected $_table = 'tb_survei';

	public function tambah($data)
	{
		return $this->db->insert_batch($this->_table, $data);
	}
	public function lihat()
	{
		$query = $this->db->get($this->_table);
		return $query->result();
	}

	public function lihat_id_jawaban($id_jawaban)
	{
		return $this->db->get_where($this->_table, ['id_jawaban' => $id_jawaban])->result();
	}

	public function hapus($id_jawaban)
	{
		return $this->db->delete($this->_table, ['id_jawaban' => $id_jawaban]);
	}
}
