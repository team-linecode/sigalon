<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	public function index()
	{
		$data['title'] = 'Users';
		$this->load->view('layout/admin/header', $data);
		$this->load->view('admin/user/index');
		$this->load->view('layout/admin/footer');
	}
}
