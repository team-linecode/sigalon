<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!check_login()) {
			$this->session->set_flashdata('error', 'Login terlebih dahulu');
			redirect('/');
		}
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$this->load->view('layout/admin/header', $data);
		$this->load->view('admin/dashboard/index');
		$this->load->view('layout/admin/footer');
	}
}
