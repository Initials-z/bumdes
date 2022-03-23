<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_login');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data = [
			'judul' => 'Halaman Login'
		];
		$this->load->view('home', $data);
	}

	public function kios()
	{
		$data = [
			'judul' => 'Halaman Login'
		];
		$this->load->view('kios', $data);
	}

	public function login_pos()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if ($this->form_validation->run() == false) {
			$data = [
				'judul' => 'Halaman Login'
			];
			$this->load->view('home', $data);
		} else {
			// $user = $this->db->get_where('t_user', ['username' => $this->input->post('username')])->row_array();
			// var_dump($user);
			// die;
			$this->_login();
		}
	}

	public function login_kios_pos()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if ($this->form_validation->run() == false) {
			$data = [
				'judul' => 'Halaman Login'
			];
			$this->load->view('kios', $data);
		} else {
			$this->_login_kios();
		}
	}

	private function _login_kios()
	{
		$username = htmlspecialchars($this->input->post('username', true));
		$password = htmlspecialchars($this->input->post('password', true));

		$user = $this->db->get_where('t_user', ['username' => $username])->row_array();

		if ($user) {
			if (password_verify($password, $user['password'])) {
				$data = [
					'username' 	=> $user['username'],
					'akses' 		=> $user['akses'],
					'akun' 			=> $user['akun'],
				];

				$this->session->set_userdata($data);

				redirect('Pengguna');
			} else {
				echo "password salah";
				$this->session->set_flashdata('pass', 'Login gagal');
				redirect('index.php/Welcome/kios');
			}
		} else {
			$this->session->set_flashdata('gagal', 'Login gagal');
			redirect('index.php/Welcome/kios');
			// echo "username salah";
		}
	}
	private function _login()
	{
		$username = htmlspecialchars($this->input->post('username', true));
		$password = htmlspecialchars($this->input->post('password', true));

		$user = $this->db->get_where('t_user', ['username' => $username])->row_array();

		if ($user) {
			if (password_verify($password, $user['password'])) {
				$data = [
					'username' => $user['username'],
					'akses' 		=> $user['akses'],
					'akun' 			=> $user['akun'],
				];

				$this->session->set_userdata($data);

				if ($user['akses'] == '0') {
					redirect('Admin');
				} elseif ($user['akses'] == '2') {
					redirect('Admin');
				} elseif ($user['akses'] == '1') {
					redirect('Pengguna');
				}
			} else {
				$this->session->set_flashdata('pass', 'Login gagal');
				redirect('Welcome');
				// echo "password salah";
			}
		} else {
			$this->session->set_flashdata('gagal', 'Login gagal');
			redirect('Welcome');
			// echo "username salah";
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('akses');
		$this->session->set_flashdata('logout', 'Anda telah logout');
		redirect('Welcome');
	}

	public function logout_pengguna()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('akses');
		$this->session->set_flashdata('logout', 'Anda telah logout');
		redirect('index.php/Welcome/kios');
	}

	public function not_found()
	{
		$data = [
			'judul' => '404'
		];

		return $this->load->view('404', $data);
	}
	public function not_found_user()
	{
		$data = [
			'judul' => '404'
		];

		return $this->load->view('404_pengguna', $data);
	}
}
