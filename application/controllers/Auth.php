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
						'id_user' => $user->id,
						'login' => TRUE
					];

					$this->session->set_userdata($data_session);
					$this->session->set_flashdata('success', 'Berhasil Login');
					redirect('dashboard');
				} else {
					$this->session->set_flashdata('success', 'Username / Password salah');
					redirect('/');
				}
			} else {
				$this->session->set_flashdata('success', 'Username / Password salah');
				redirect('/');
			}
		}
	}

	public function logout()
	{
		$user_data = $this->session->all_userdata();
		foreach ($user_data as $key => $value) {
			$this->session->unset_userdata($key);
		}
		$this->session->set_flashdata('success', 'Berhasil logout');
		redirect('/');
	}
}
