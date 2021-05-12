<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function index()
	{
		$this->load->view('layout/auth/header');
		$this->load->view('auth/login');
		$this->load->view('layout/auth/footer');
	}
}
