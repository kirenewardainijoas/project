<?php

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->login['role'] != 'customer' && $this->session->login['role'] != 'user') redirect();
		$this->data['aktif'] = 'dashboard';
		$this->load->model('M_pertanyaan', 'm_pertanyaan');
		$this->load->model('M_customer', 'm_customer');
		$this->load->model('M_jawaban', 'm_jawaban');
		$this->load->model('M_user', 'm_user');
		$this->load->model('M_survei', 'm_survei');
	}
	public function index()
	{
		$this->data['title'] = 'Halaman Dashboard';
		$this->data['jumlah_customer'] = $this->m_customer->jumlah();
		$this->data['jumlah_jawaban'] = $this->m_jawaban->jumlah();
		$this->data['jumlah_user'] = $this->m_user->jumlah();
		$this->data['survei'] = $this->m_survei->lihat();
		$this->load->view('dashboard', $this->data);
	}
}
