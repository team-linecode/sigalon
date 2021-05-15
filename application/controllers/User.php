<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function index()
	{
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required|is_unique[users.phone]');
		$this->form_validation->set_rules('level', 'Level', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Users';
			$data['users'] = $this->db->get('users')->result();
			$this->load->view('layout/admin/header', $data);
			$this->load->view('admin/user/index', $data);
			$this->load->view('layout/admin/footer');
		} else {
			$data = [
				'name' => $this->input->post('name'),
				'username' => $this->input->post('username'),
				'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
				'nohash' => $this->input->post('password'),
				'phone' => $this->input->post('phone'),
				'level' => $this->input->post('level')
			];

			$this->db->insert('users', $data);
			redirect('user');
		}
	}
	
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('users');
		redirect('user');
	}
}
