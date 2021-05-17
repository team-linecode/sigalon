<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function index()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout/auth/header');
			$this->load->view('auth/login');
			$this->load->view('layout/auth/footer');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$user = $this->db->get_where('users', ['username' => $username])->row();

			if ($user != NULL) {
				if (password_verify($password, $user->password)) {
					$data_session = [
						'name' => $user->name,
						'username' => $user->username
					];

					$this->session->set_userdata($data_session);
					redirect('admin');
				} else {
					echo "username / password salah 2";
				}
			} else {
				echo "username / password salah 1";
			}
		}
	}
}
