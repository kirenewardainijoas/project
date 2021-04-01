<?php

use Dompdf\Dompdf;

class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if($this->session->login['role'] != 'user' && $this->session->login['role'] != 'user') redirect();
		$this->data['aktif'] = 'user';
		$this->load->model('M_user', 'm_user');
	}

	public function index(){
		if ($this->session->login['role'] == 'user'){
			$this->session->set_flashdata('error', 'Managemen Pengguna hanya untuk user!');
			redirect('jawaban');
		}

		$this->data['title'] = 'Data User';
		$this->data['all_user'] = $this->m_user->lihat();
		$this->data['no'] = 1;

		$this->load->view('user/lihat', $this->data);
	}

	public function tambah(){
		if ($this->session->login['role'] == 'user'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk user!');
			redirect('jawaban');
		}

		$this->data['title'] = 'Tambah user';

		$this->load->view('user/tambah', $this->data);
	}

	public function proses_tambah(){
		if ($this->session->login['role'] == 'user'){
			$this->session->set_flashdata('error', 'Tambah data hanya untuk user!');
			redirect('jawaban');
		}

		$data = [
			'id_user' => $this->input->post('id_user'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'nama' => $this->input->post('nama'),
			];

		if($this->m_user->tambah($data)){
			$this->session->set_flashdata('success', 'Data user <strong>Berhasil</strong> Ditambahkan!');
			redirect('jawaban');
		} else {
			$this->session->set_flashdata('error', 'Data user <strong>Gagal</strong> Ditambahkan!');
			redirect('jawaban');
		}
	}

	public function ubah($id_user){
		if ($this->session->login['role'] == 'user'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk user!');
			redirect('jawaban');
		}

		$this->data['title'] = 'Ubah user';
		$this->data['user'] = $this->m_user->lihat_id($id_user);

		$this->load->view('user/ubah', $this->data);
	}

	public function proses_ubah($id_user){
		if ($this->session->login['role'] == 'user'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk user!');
			redirect('jawaban');
		}

		$data = [
			'id_user' => $this->input->post('id_user'),
			'email' => $this->input->post('email'),
			'password' => $this->input->post('password'),
			'nama' => $this->input->post('nama'),
			];

		if($this->m_user->ubah($data, $id_user)){
			$this->session->set_flashdata('success', 'Data user <strong>Berhasil</strong> Diubah!');
			redirect('jawaban');
		} else {
			$this->session->set_flashdata('error', 'Data user <strong>Gagal</strong> Diubah!');
			redirect('jawaban');
		}
	}

	public function hapus($id_user){
		if ($this->session->login['role'] == 'user'){
			$this->session->set_flashdata('error', 'Ubah data hanya untuk user!');
			redirect('jawaban');
		}

		if($this->m_user->hapus($id_user)){
			$this->session->set_flashdata('success', 'Data User <strong>Berhasil</strong> Dihapus!');
			redirect('jawaban');
		} else {
			$this->session->set_flashdata('error', 'Data user <strong>Gagal</strong> Dihapus!');
			redirect('jawaban');
		}
	}

	public function export(){
		$dompdf = new Dompdf();
		// $this->data['perusahaan'] = $this->m_usaha->lihat();
		$this->data['all_user'] = $this->m_user->lihat();
		$this->data['title'] = 'Laporan Data user';
		$this->data['no'] = 1;

		$dompdf->setPaper('A4', 'Landscape');
		$html = $this->load->view('user/report', $this->data, true);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream('Laporan Data user Tanggal ' . date('d F Y'), array("Attachment" => false));
	}
}