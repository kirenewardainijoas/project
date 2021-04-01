<?php

use Dompdf\Dompdf;

class Pertanyaan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->login['role'] != 'customer' && $this->session->login['role'] != 'user') redirect();
		$this->data['aktif'] = 'pertanyaan';
		$this->load->model('M_pertanyaan', 'm_pertanyaan');
	}

	public function index()
	{
		$this->data['title'] = 'Data Pertanyaan';
		$this->data['all_pertanyaan'] = $this->m_pertanyaan->lihat();
		$this->data['no'] = 1;

		$this->load->view('pertanyaan/lihat', $this->data);
	}

	public function tambah()
	{
		if ($this->session->login['role'] == 'pertanyaan') {
			$this->session->set_flashdata('error', 'Tambah soal hanya untuk admin!');
			redirect('jawaban');
		}

		$this->data['title'] = 'Tambah soal ';

		$this->load->view('pertanyaan/tambah', $this->data);
	}

	public function proses_tambah()
	{
		if ($this->session->login['role'] == 'pertanyaan') {
			$this->session->set_flashdata('error', 'Tambah soal hanya untuk admin!');
			redirect('jawaban');
		}

		$data = [
			'id_pertanyaan' => $this->input->post('id_pertanyaan'),
			'soal' => $this->input->post('soal'),
		];

		if ($this->m_pertanyaan->tambah($data)) {
			$this->session->set_flashdata('success', 'Data pertanyaan <strong>Berhasil</strong> Ditambahkan!');
			redirect('jawaban');
		} else {
			$this->session->set_flashdata('error', 'Data pertanyaan <strong>Gagal</strong> Ditambahkan!');
			redirect('jawaban');
		}
	}

	public function ubah($id_pertanyaan)
	{
		if ($this->session->login['role'] == 'pertanyaan') {
			$this->session->set_flashdata('error', 'Ubah soal hanya untuk admin!');
			redirect('pertanyaan');
		}

		$this->data['title'] = 'Ubah soal';
		$this->data['pertanyaan'] = $this->m_pertanyaan->lihat_id($id_pertanyaan);

		$this->load->view('pertanyaan/ubah', $this->data);
	}

	public function proses_ubah($id_pertanyaan)
	{
		if ($this->session->login['role'] == 'pertanyaan') {
			$this->session->set_flashdata('error', 'Ubah soal hanya untuk admin!');
			redirect('pertanyaan');
		}

		$data = [
			'id_pertanyaan' => $this->input->post('id_pertanyaan'),
			'soal' => $this->input->post('soal'),
		];

		if ($this->m_pertanyaan->ubah($data, $id_pertanyaan)) {
			$this->session->set_flashdata('success', 'Data pertanyaan <strong>Berhasil</strong> Diubah!');
			redirect('pertanyaan');
		} else {
			$this->session->set_flashdata('error', 'Data pertanyaan <strong>Gagal</strong> Diubah!');
			redirect('pertanyaan');
		}
	}

	public function hapus($id_pertanyaan)
	{
		if ($this->session->login['role'] == 'pertanyaan') {
			$this->session->set_flashdata('error', 'Hapus data pertanyaan hanya untuk admin!');
			redirect('jawaban');
		}

		if ($this->m_pertanyaan->hapus($id_pertanyaan)) {
			$this->session->set_flashdata('success', 'Data pertanyaan <strong>Berhasil</strong> Dihapus!');
			redirect('jawaban');
		} else {
			$this->session->set_flashdata('error', 'Data pertanyaan <strong>Gagal</strong> Dihapus!');
			redirect('jawaban');
		}
	}

	// public function export(){
	// 	$dompdf = new Dompdf();
	// 	// $this->data['perusahaan'] = $this->m_usaha->lihat();
	// 	$this->data['all_pertanyaan'] = $this->m_pertanyaan->lihat();
	// 	$this->data['title'] = 'Laporan Data pertanyaan';
	// 	$this->data['no'] = 1;

	// 	$dompdf->setPaper('A4', 'Landscape');
	// 	$html = $this->load->view('pertanyaan/report', $this->data, true);
	// 	$dompdf->load_html($html);
	// 	$dompdf->render();
	// 	$dompdf->stream('Laporan Data pertanyaan Tanggal ' . date('d F Y'), array("Attachment" => false));
	// }
}
