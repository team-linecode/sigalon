<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_login();
		guard('Admin');
	}

	public function index()
	{
		$day = date('d');
		$moon = date('m');
		$year = date('Y');

		// Pendapatan Kotor
		$gross_income = $this->db->query("SELECT SUM(total) as total FROM transactions WHERE type = 'out' AND status = 'Completed'")->row();
		$gross_income_month = $this->db->query("SELECT SUM(total) as total FROM transactions WHERE type = 'out' AND status = 'Completed' AND MONTH(completed_at) = '$moon' AND YEAR(completed_at) = '$year'")->row();
		$gross_income_day = $this->db->query("SELECT SUM(total) as total FROM transactions WHERE type = 'out' AND status = 'Completed' AND DAY(completed_at) = '$day' AND MONTH(completed_at) = '$moon' AND YEAR(completed_at) = '$year'")->row();
		
		// Pendapatan Bersih
		$income = $this->db->query("SELECT SUM(income) as income FROM transactions WHERE type = 'out' AND status = 'Completed'")->row();
		$income_month = $this->db->query("SELECT SUM(income) as income FROM transactions WHERE type = 'out' AND status = 'Completed' AND MONTH(completed_at) = '$moon' AND YEAR(completed_at) = '$year'")->row();
		$income_day = $this->db->query("SELECT SUM(income) as income FROM transactions WHERE type = 'out' AND status = 'Completed' AND DAY(completed_at) = '$day' AND MONTH(completed_at) = '$moon' AND YEAR(completed_at) = '$year'")->row();

		// Jumlah Transaksi Keluar
		$trx_out = $this->db->query("SELECT * FROM transactions LEFT JOIN products ON transactions.id_product = products.id WHERE transactions.status = 'completed' AND transactions.type = 'out'")->result();
		$trx_out_month = $this->db->query("SELECT * FROM transactions LEFT JOIN products ON transactions.id_product = products.id WHERE transactions.status = 'Completed' AND transactions.type = 'out' AND MONTH(transactions.completed_at) = '$moon' AND YEAR(transactions.completed_at) = '$year'")->result();
		$trx_out_day = $this->db->query("SELECT * FROM transactions LEFT JOIN products ON transactions.id_product = products.id WHERE transactions.status = 'Completed' AND transactions.type = 'out' AND DAY(transactions.completed_at) = '$day' AND MONTH(transactions.completed_at) = '$moon' AND YEAR(transactions.completed_at) = '$year'")->result();

		$data['title'] = 'Dashboard';
		$data['gross_income'] = $gross_income->total;
		$data['gross_income_month'] = $gross_income_month->total;
		$data['gross_income_day'] = $gross_income_day->total;
		$data['total_income'] = $income->income;
		$data['total_income_trx'] = count($trx_out);
		$data['total_income_month'] = $income_month->income;
		$data['total_income_month_trx'] = count($trx_out_month);
		$data['total_income_day'] = $income_day->income;
		$data['total_income_day_trx'] = count($trx_out_day);
		$data['paid'] = $this->db->query("SELECT *, transactions.status as trx_status, products.status as product_status, products.name as product_name, users.name as user_name FROM transactions LEFT JOIN users ON transactions.id_user = users.id LEFT JOIN products ON transactions.id_product = products.id WHERE transactions.status = 'Paid' AND transactions.type = 'out'")->result();
		$data['process'] = $this->db->query("SELECT *, transactions.status as trx_status, products.status as product_status, products.name as product_name, users.name as user_name FROM transactions LEFT JOIN users ON transactions.id_user = users.id LEFT JOIN products ON transactions.id_product = products.id WHERE transactions.status = 'On Process' AND transactions.type = 'out'")->result();
		
		$this->load->view('layout/admin/header', $data);
		$this->load->view('admin/dashboard/index');
		$this->load->view('layout/admin/footer');
	}
}
