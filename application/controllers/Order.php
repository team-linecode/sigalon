<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!check_login()) {
			$this->session->set_flashdata('error', 'Login terlebih dahulu');
			redirect('/');
		}
		$this->load->model('Transaction_model', 'Transaction');
	}
	
	public function index()
	{
		$data['title'] = 'Daftar Pesanan Saya';
		$data['transactions'] = $this->Transaction->get_where('id_user', user()->id)->result();

		$this->load->view('layout/admin/header', $data);
		$this->load->view('admin/transaction/index', $data);
		$this->load->view('layout/admin/footer');
	}
}
