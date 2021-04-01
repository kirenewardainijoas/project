<?php

use Dompdf\Dompdf;

class Customer extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->login['role'] != 'customer' && $this->session->login['role'] != 'user') redirect();
		$this->data['aktif'] = 'customer';
		$this->load->model('M_customer', 'm_customer');
	}

	public function index()
	{
		$this->data['title'] = 'Data Customer';
		$this->data['all_customer'] = $this->m_customer->lihat();
		$this->data['no'] = 1;

		$this->load->view('customer/lihat', $this->data);
	}

	public function tambah()
	{
		if ($this->session->login['role'] == 'customer') {
			$this->session->set_flashdata('error', 'Tambah data hanya untuk User Admin!');
			redirect('customer');
		}

		$this->data['title'] = 'Tambah Customer';

		$this->load->view('customer/tambah', $this->data);
	}

	public function proses_tambah()
	{
		if ($this->session->login['role'] == 'customer') {
			$this->session->set_flashdata('error', 'Tambah data hanya untuk User Admin!');
			redirect('customer');
		}

		$data = [
			'id_customer' => $this->input->post('id_customer'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'no_telp' => $this->input->post('no_telp'),
		];

		if ($this->m_customer->tambah($data)) {
			$this->session->set_flashdata('success', 'Data Anda <strong>Berhasil</strong> Ditambahkan!');
			redirect('customer');
		} else {
			$this->session->set_flashdata('error', 'Data Anda <strong>Gagal</strong> Ditambahkan!');
			redirect('customer');
		}
	}

	public function ubah($id_customer)
	{
		if ($this->session->login['role'] == 'customer') {
			// $this->session->set_flashdata('error', 'Ubah data hanya untuk User Admin!');
			// redirect('custome/ubah');
		}

		$this->data['title'] = 'Ubah Data customer';
		$this->data['customer'] = $this->m_customer->lihat_id($id_customer);

		$this->load->view('customer/ubah', $this->data);
	}

	public function proses_ubah($id_customer)
	{
		if ($this->session->login['role'] == 'customer') {
			// $this->session->set_flashdata('error', 'Ubah data hanya untuk User Admin!');
			// redirect('customer');
		}

		$data = [
			'id_customer' => $this->input->post('id_customer'),
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'no_telp' => $this->input->post('no_telp'),
		];

		if ($this->m_customer->ubah($data, $id_customer)) {
			$this->session->set_flashdata('success', 'Data Anda <strong>Berhasil</strong> Diubah!');
			redirect('customer');
		} else {
			$this->session->set_flashdata('error', 'Data Anda <strong>Gagal</strong> Diubah!');
			redirect('customer');
		}
	}

	public function hapus($id_customer)
	{
		if ($this->session->login['role'] == 'customer') {
			$this->session->set_flashdata('error', 'Hapus data hanya untuk customer!');
			redirect('customer');
		}

		if ($this->m_customer->hapus($id_customer)) {
			$this->session->set_flashdata('success', 'Data Customer <strong>Berhasil</strong> Dihapus!');
			redirect('customer');
		} else {
			$this->session->set_flashdata('error', 'Data Customer <strong>Gagal</strong> Dihapus!');
			redirect('customer');
		}
	}

	public function export()
	{
		$dompdf = new Dompdf();
		$this->data['all_customer'] = $this->m_customer->lihat();
		$this->data['title'] = 'Laporan Data Customer';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('customer/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data customer Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}
