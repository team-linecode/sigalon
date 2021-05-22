<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function index()
	{
		$day = date('d');
		$moon = date('m');
		$year = date('Y');

		$gross_income = $this->db->query("SELECT SUM(total) as total FROM transactions WHERE type = 'out'")->row();
		$gross_income_month = $this->db->query("SELECT SUM(total) as total FROM transactions WHERE type = 'out' AND MONTH(transactions.completed_at) = '$moon' AND YEAR(transactions.completed_at) = '$year'")->row();
		$gross_income_day = $this->db->query("SELECT SUM(total) as total FROM transactions WHERE type = 'out' AND DAY(transactions.completed_at) = '$day' AND MONTH(transactions.completed_at) = '$moon' AND YEAR(transactions.completed_at) = '$year'")->row();

		// Total Pendapatan Bersih
		$trx_out = $this->db->query("SELECT * FROM transactions LEFT JOIN products ON transactions.id_product = products.id WHERE transactions.status = 'completed' AND transactions.type = 'out'")->result();
		$profit_all = 0;
		foreach ($trx_out as $out){
			$get_supplier = $this->db->query("SELECT * FROM products LEFT JOIN suppliers ON products.id_supplier = suppliers.id WHERE products.id = '$out->id_product'")->row();
			$profit = ($out->price - $get_supplier->unit_price);
			$total_profit = ($profit * $out->qty);

			$profit_all += $total_profit; 
		}

		// Pendapatan Bersih Bulan ini
		$trx_out_month = $this->db->query("SELECT * FROM transactions LEFT JOIN products ON transactions.id_product = products.id WHERE transactions.status = 'Completed' AND transactions.type = 'out' AND MONTH(transactions.completed_at) = '$moon' AND YEAR(transactions.completed_at) = '$year'")->result();
		$profit_month = 0;
		foreach ($trx_out_month as $out){
			$get_supplier = $this->db->query("SELECT * FROM products LEFT JOIN suppliers ON products.id_supplier = suppliers.id WHERE products.id = '$out->id_product'")->row();
			$profit = ($out->price - $get_supplier->unit_price);
			$total_profit_month = ($profit * $out->qty);
			
			$profit_month += $total_profit_month; 
		}
		
		// Pendapatan Bersih Hari ini
		$trx_out_day = $this->db->query("SELECT * FROM transactions LEFT JOIN products ON transactions.id_product = products.id WHERE transactions.status = 'Completed' AND transactions.type = 'out' AND DAY(transactions.completed_at) = '$day' AND MONTH(transactions.completed_at) = '$moon' AND YEAR(transactions.completed_at) = '$year'")->result();
		$profit_day = 0;
		foreach ($trx_out_day as $out){
			$get_supplier = $this->db->query("SELECT * FROM products LEFT JOIN suppliers ON products.id_supplier = suppliers.id WHERE products.id = '$out->id_product'")->row();
			$profit = ($out->price - $get_supplier->unit_price);
			$total_profit_day = ($profit * $out->qty);
			
			$profit_day += $total_profit_day; 
		}
		
		$data['title'] = 'Dashboard';
		$data['gross_income'] = $gross_income->total;
		$data['gross_income_month'] = $gross_income_month->total;
		$data['gross_income_day'] = $gross_income_day->total;
		$data['total_income'] = $profit_all;
		$data['total_income_trx'] = count($trx_out);
		$data['total_income_month'] = $profit_month;
		$data['total_income_month_trx'] = count($trx_out_month);
		$data['total_income_day'] = $profit_day;
		$data['total_income_day_trx'] = count($trx_out_day);
		$data['paid'] = $this->db->query("SELECT *, transactions.status as trx_status, products.status as product_status, products.name as product_name, users.name as user_name FROM transactions LEFT JOIN users ON transactions.id_user = users.id LEFT JOIN products ON transactions.id_product = products.id WHERE transactions.status = 'Paid' AND transactions.type = 'out'")->result();
		$data['process'] = $this->db->query("SELECT *, transactions.status as trx_status, products.status as product_status, products.name as product_name, users.name as user_name FROM transactions LEFT JOIN users ON transactions.id_user = users.id LEFT JOIN products ON transactions.id_product = products.id WHERE transactions.status = 'On Process' AND transactions.type = 'out'")->result();
		$this->load->view('layout/admin/header', $data);
		$this->load->view('admin/dashboard/index');
		$this->load->view('layout/admin/footer');
	}
}
