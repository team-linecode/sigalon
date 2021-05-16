<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{
	public function index()
	{
		$data['title'] = 'Transaksi';
		$data['transactions'] = $this->db->query('SELECT * FROM transactions JOIN products ON transactions.id_product = products.id JOIN users ON transactions.id_user = users.id JOIN payment_methods ON transactions.id_payment_method = payment_methods.id')->result();
		$this->load->view('layout/admin/header', $data);
		$this->load->view('admin/transaction/index', $data);
		$this->load->view('layout/admin/footer');
	}

	public function create()
	{
		$data['title'] = 'Tambah Transaksi';
		$data['transactions'] = $this->db->query('SELECT * FROM transactions JOIN products ON transactions.id_product = products.id JOIN users ON transactions.id_user = users.id JOIN payment_methods ON transactions.id_payment_method = payment_methods.id')->result();
		$data['products'] = $this->db->get('products')->result();
		$data['payment_methods'] = $this->db->get('payment_methods')->result();

		$this->load->view('layout/admin/header', $data);
		$this->load->view('admin/transaction/create', $data);
		$this->load->view('layout/admin/footer');
	}
}
