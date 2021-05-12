<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_Method extends CI_Controller
{
	public function index()
	{
		$data['title'] = 'Metode Pembayaran';
		$this->load->view('layout/admin/header', $data);
		$this->load->view('admin/payment_method/index');
		$this->load->view('layout/admin/footer');
	}
}
