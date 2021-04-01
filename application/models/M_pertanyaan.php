<?php

class M_pertanyaan extends CI_Model
{
	protected $_table = 'tb_pertanyaan';

	public function lihat()
	{
		$dataPertanyaan = [];

		$queryPertanyaan = $this->db->get('tb_pertanyaan');

		if ($queryPertanyaan->num_rows() > 0) {
			foreach ($queryPertanyaan->result_array() as $kolomPertanyaan) {
				$where = ['id_pertanyaan' => $kolomPertanyaan['id_pertanyaan']];
				$queryJawaban = $this->db->get_where('tb_jawaban', $where);

				$dataJawaban = [];

				if ($queryJawaban->num_rows() > 0) {
					foreach ($queryJawaban->result_array() as $kolomJawaban) {
						array_push($dataJawaban, $kolomJawaban);
					}
				}
				array_push($dataPertanyaan, [
					'id_pertanyaan' => $kolomPertanyaan['id_pertanyaan'],
					'soal'			=> $kolomPertanyaan['soal'],
					'dataJawaban'	=> $dataJawaban
				]);
			}
		}
		return $dataPertanyaan;
	}

	public function lihat_id($id_pertanyaan)
	{
		$query = $this->db->get_where($this->_table, ['id_pertanyaan' => $id_pertanyaan]);
		return $query->row();
	}

	public function lihat_pertanyaan($pertanyaan)
	{
		$query = $this->db->select('id_pertanyaan');
		$query = $this->db->where(['id_pertanyaan' => $pertanyaan]);
		$query = $this->db->get($this->_table);
		return $query->row();
	}

	public function tambah($data)
	{
		return $this->db->insert($this->_table, $data);
	}


	public function ubah($data, $id_pertanyaan)
	{
		$query = $this->db->set($data);
		$query = $this->db->where(['id_pertanyaan' => $id_pertanyaan]);
		$query = $this->db->update($this->_table);
		return $query;
	}

	public function hapus($id_pertanyaan)
	{
		return $this->db->delete($this->_table, ['id_pertanyaan' => $id_pertanyaan]);
	}
}
