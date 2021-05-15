<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function index()
	{
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
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

	public function edit($id)
	{
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'required');
		$this->form_validation->set_rules('level', 'Level', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Edit User';
			$data['user'] = $this->db->get_where('users', ['id' => $id])->row();
			$this->load->view('layout/admin/header', $data);
			$this->load->view('admin/user/edit', $data);
			$this->load->view('layout/admin/footer');
		} else {
			$user = $this->db->get_where('users', ['id' => $id])->row();
			$check_username = $this->db->get_where('users', ['username' => $this->input->post('username')])->result();
			$check_phone = $this->db->get_where('users', ['phone' => $this->input->post('phone')])->result();

			if (count($check_username) > 0 && $user->username != $this->input->post('username')) {
				redirect('user/edit/' . $id);
			}

			if (count($check_phone) > 0 && $user->phone != $this->input->post('phone')) {
				redirect('user/edit/' . $id);
			}

			$data = [
				'name' => $this->input->post('name'),
				'username' => $this->input->post('username'),
				'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
				'nohash' => $this->input->post('password'),
				'phone' => $this->input->post('phone'),
				'level' => $this->input->post('level')
			];

			$this->db->where('id', $id);
			$this->db->update('users', $data);
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
