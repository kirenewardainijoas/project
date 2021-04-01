<?php

use Dompdf\Dompdf;

class Jawaban extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->login['role'] != 'customer' && $this->session->login['role'] != 'user_admin') redirect();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('M_pertanyaan', 'm_pertanyaan');
		$this->load->model('M_jawaban', 'm_jawaban');
		$this->load->model('M_survei', 'm_survei');
		$this->data['aktif'] = 'jawaban';
	}

	public function index()
	{
		$this->data['title'] = 'Data jawaban';
		$this->data['all_jawaban'] = $this->m_jawaban->lihat();

		$this->load->view('jawaban/lihat', $this->data);
	}

	public function tambah()
	{
		$this->data['title'] = 'Tambah jawaban';
		$this->data['all_pertanyaan'] = $this->m_pertanyaan->lihat_pertanyaan();

		$this->load->view('jawaban/tambah', $this->data);
	}

	public function proses_tambah()
	{
		$jumlah_pertanyaan_customer = count($this->input->post('pertanyaan_hidden'));

		$data_jawaban = [
			'id_jawaban' => $this->input->post('id_jawaban'),
			'id_pertanyaan' => $this->input->post('id_pertanyaan'),
			'jawaban' => $this->input->post('jawaban'),
		];

		$data_survei = [];

		for ($i = 0; $i < $jumlah_pertanyaan_customer; $i++) {
			array_push($data_survei, ['id_pertanyaan' => $this->input->post('pertanyaan_hidden')[$i]]);
			$data_survei[$i]['id_survei'] = $this->input->post('id_survei');
			$data_survei[$i]['id_customer'] = $this->input->post('customer_hidden');
			$data_survei[$i]['id_jawaban'] = $this->input->post('jawaban_hidden');
			$data_survei[$i]['tanggal'] = $this->input->post('tanggal_hidden')[$i];
		}

		if ($this->m_jawaban->tambah($data_jawaban) && $this->m_survei->tambah($data_survei)) {
			for ($i = 0; $i < $jumlah_pertanyaan_customer; $i++) {
				$this->m_pertanyaan->min_stok($data_survei[$i]['jumlah_pertanyaan'], $data_survei[$i]['nama_pertanyaan']) or die('gagal min soal');
			}
			$this->session->set_flashdata('success', 'Invoice <strong>jawaban</strong> Berhasil Dibuat!');
			redirect('jawaban');
		} else {
			$this->session->set_flashdata('success', 'Invoice <strong>jawaban</strong> Berhasil Dibuat!');
			redirect('jawaban');
		}
	}

	public function detail($id_jawaban)
	{
		$this->data['title'] = 'Survei Jawaban ';
		$this->data['jawaban'] = $this->m_jawaban->lihat_id_jawaban($id_jawaban);
		$this->data['all_survei'] = $this->m_survei->lihat_id_jawaban($id_jawaban);
		$this->data['no'] = 1;

		$this->load->view('jawaban/detail', $this->data);
	}

	public function hapus($id_jawaban)
	{
		if ($this->m_jawaban->hapus($id_jawaban) && $this->m_survei->hapus($id_jawaban)) {
			$this->session->set_flashdata('success', 'jawaban <strong>Berhasil</strong> Dihapus!');
			redirect('jawaban');
		} else {
			$this->session->set_flashdata('error', 'jawaban <strong>Gagal</strong> Dihapus!');
			redirect('jawaban');
		}
	}


	public function get_all_pertanyaan()
	{
		$data = $this->m_pertanyaan->lihat_pertanyaan($_POST['soal']);
		echo json_encode($data);
	}

	// public function keranjang_jawaban(){
	// 	$this->load->view('penjualan/keranjang');
	// }

	public function export()
	{
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_jawaban'] = $this->m_jawaban->lihat();
		$this->data['title'] = 'Laporan Data jawaban';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('jawaban/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data jawaban Tanggal ' . date('d F Y'), array("Attachment" => false));
	}

	public function export_survei($id_jawaban)
	{
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['jawaban'] = $this->m_jawaban->lihat_id_jawaban($id_jawaban);
		$this->data['all_survei'] = $this->m_survei->lihat_survei($id_jawaban);
		$this->data['title'] = 'Laporan Detail survei';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('jawaban/detail_report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Detail survei Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}
