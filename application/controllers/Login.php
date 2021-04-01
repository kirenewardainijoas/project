<?php

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		if ($this->session->login) redirect('dashboard');
		$this->load->model('M_customer', 'm_customer');
		$this->load->model('M_user', 'm_user');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function proses_login()
	{
		if ($this->input->post('role') === 'customer') $this->_proses_login_customer($this->input->post('email'));
		elseif ($this->input->post('role') === 'user') $this->_proses_login_user($this->input->post('email'));
		else {
?>
			<script>
				alert('role tidak tersedia!')
			</script>
<?php
		}
	}

	protected function _proses_login_customer($email)
	{
		$get_customer = $this->m_customer->lihat_email($email);
		if ($get_customer) {
			if ($get_customer->password == $this->input->post('password')) {
				$session = [
					'id_customer' => $get_customer->id_customer,
					'nama' => $get_customer->nama,
					'alamat' => $get_customer->alamat,
					'email' => $get_customer->email,
					'password' => $get_customer->password,
					'role' => $this->input->post('role'),
					'jam_masuk' => date('H:i:s')
				];

				$this->session->set_userdata('login', $session);
				$this->session->set_flashdata('success', '<strong>Login</strong> Berhasil!');
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('error', 'Password Salah!');
				redirect();
			}
		} else {
			$this->session->set_flashdata('error', 'Email Salah!');
			redirect();
		}
	}

	protected function _proses_login_user($email)
	{
		$get_user = $this->m_user->lihat_email($email);
		if ($get_user) {
			if ($get_user->password == $this->input->post('password')) {
				$session = [
					'id_user' => $get_user->id_user,
					'nama' => $get_user->nama,
					'email' => $get_user->email,
					'password' => $get_user->password,
					'role' => $this->input->post('role'),
					'jam_masuk' => date('H:i:s')
				];

				$this->session->set_userdata('login', $session);
				$this->session->set_flashdata('success', '<strong>Login</strong> Berhasil!');
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('error', 'Password Salah!');
				redirect();
			}
		} else {
			$this->session->set_flashdata('error', 'Email Salah!');
			redirect();
		}
	}
}
