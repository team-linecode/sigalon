<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function index()
	{
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
		$moon = date('m');
		$year = date('Y');
		$trx_out_month = $this->db->query("SELECT * FROM transactions LEFT JOIN products ON transactions.id_product = products.id WHERE transactions.status = 'Completed' AND transactions.type = 'out' AND MONTH(transactions.completed_at) = '$moon' AND YEAR(transactions.completed_at) = '$year'")->result();
		$profit_month = 0;
		foreach ($trx_out_month as $out){
			$get_supplier = $this->db->query("SELECT * FROM products LEFT JOIN suppliers ON products.id_supplier = suppliers.id WHERE products.id = '$out->id_product'")->row();
			$profit = ($out->price - $get_supplier->unit_price);
			$total_profit_month = ($profit * $out->qty);
			
			$profit_month += $total_profit_month; 
		}
		
		// Pendapatan Bersih Hari ini
		$day = date('d');
		$moon = date('m');
		$year = date('Y');
		$trx_out_day = $this->db->query("SELECT * FROM transactions LEFT JOIN products ON transactions.id_product = products.id WHERE transactions.status = 'Completed' AND transactions.type = 'out' AND DAY(transactions.completed_at) = '$day' AND MONTH(transactions.completed_at) = '$moon' AND YEAR(transactions.completed_at) = '$year'")->result();
		$profit_day = 0;
		foreach ($trx_out_day as $out){
			$get_supplier = $this->db->query("SELECT * FROM products LEFT JOIN suppliers ON products.id_supplier = suppliers.id WHERE products.id = '$out->id_product'")->row();
			$profit = ($out->price - $get_supplier->unit_price);
			$total_profit_day = ($profit * $out->qty);
			
			$profit_day += $total_profit_day; 
		}
		
		$data['title'] = 'Dashboard';
		$data['total_pendapatan'] = $profit_all;
		$data['total_pendapatan_trx'] = count($trx_out);
		$data['total_pendapatan_bulan'] = $profit_month;
		$data['total_pendapatan_bulan_trx'] = count($trx_out_month);
		$data['total_pendapatan_hari'] = $profit_day;
		$data['total_pendapatan_hari_trx'] = count($trx_out_day);
		$data['paid'] = $this->db->query("SELECT *, transactions.status as trx_status, products.status as product_status, products.name as product_name, users.name as user_name FROM transactions LEFT JOIN users ON transactions.id_user = users.id LEFT JOIN products ON transactions.id_product = products.id WHERE transactions.status = 'Paid' AND transactions.type = 'out'")->result();
		$data['process'] = $this->db->query("SELECT *, transactions.status as trx_status, products.status as product_status, products.name as product_name, users.name as user_name FROM transactions LEFT JOIN users ON transactions.id_user = users.id LEFT JOIN products ON transactions.id_product = products.id WHERE transactions.status = 'On Process' AND transactions.type = 'out'")->result();
		$this->load->view('layout/admin/header', $data);
		$this->load->view('admin/dashboard/index');
		$this->load->view('layout/admin/footer');
	}
}
