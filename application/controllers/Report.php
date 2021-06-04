<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
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
		$data['title'] = 'Laporan';
		$this->load->view('layout/admin/header', $data);
		$this->load->view('admin/report/index');
		$this->load->view('layout/admin/footer');
	}

	public function print()
	{
		$this->load->view('admin/report/print');
	}
	
	public function view()
	{
		$type = $this->input->post('type');
		$status = $this->input->post('status');
		$from_date = $this->input->post('from_date');
		$till_date = $this->input->post('till_date');
		$total = $this->db->query("SELECT SUM(total) as total FROM transaction_products LEFT JOIN transactions ON transaction_products.id_transaction = transactions.id WHERE transactions.status = '$status' AND transactions.type = '$type' AND DATE(transactions.date) >= '$from_date' AND DATE(transactions.date) <= '$till_date'")->row();
		$qty = $this->db->query("SELECT SUM(qty) as qty FROM transaction_products LEFT JOIN transactions ON transaction_products.id_transaction = transactions.id WHERE transactions.status = '$status' AND transactions.type = '$type' AND DATE(transactions.date) >= '$from_date' AND DATE(transactions.date) <= '$till_date'")->row();
		$income = $this->db->query("SELECT SUM(income) as income FROM transaction_products LEFT JOIN transactions ON transaction_products.id_transaction = transactions.id WHERE transactions.status = '$status' AND transactions.type = '$type' AND DATE(transactions.date) >= '$from_date' AND DATE(transactions.date) <= '$till_date'")->row();

		$data['report'] = $this->db->query("SELECT *, products.name as product_name, suppliers.name as supplier_name, users.name as user_name FROM transaction_products LEFT JOIN transactions ON transaction_products.id_transaction = transactions.id LEFT JOIN suppliers ON transactions.id_supplier = suppliers.id LEFT JOIN products ON transaction_products.id_product = products.id LEFT JOIN users ON transactions.id_user = users.id WHERE transactions.status = '$status' AND transactions.type = '$type' AND DATE(transactions.date) >= '$from_date' AND DATE(transactions.date) <= '$till_date'")->result();
		
		$data['from_date'] = $from_date;
		$data['till_date'] = $till_date;
		$data['type'] = $type;
		$data['total'] = $total->total;
		$data['qty'] = $qty->qty;
		$data['income'] = $income->income;
		$this->load->view('admin/report/view', $data);
	}
}
