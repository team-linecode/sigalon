<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
	public function index()
	{
		$data['title'] = 'Daftar Pesanan Saya';
		$id_user = user()->id;
		$data['transactions'] = $this->db->query("SELECT *,
		products.name as product_name,
		suppliers.name as supplier_name,
		suppliers.phone as supplier_phone,
		suppliers.price as supplier_price,
		users.name as user_name,
		transactions.status as trx_status,
		transactions.id as trx_id,
		transactions.type as trx_type
		FROM transactions
		LEFT JOIN products ON transactions.id_product = products.id
		LEFT JOIN suppliers ON products.id_supplier = suppliers.id
		LEFT JOIN users ON transactions.id_user = users.id
		LEFT JOIN payment_methods ON transactions.id_payment_method = payment_methods.id
		WHERE transactions.id_user = '$id_user'
		GROUP BY transactions.id DESC")->result();

		$this->load->view('layout/admin/header', $data);
		$this->load->view('admin/transaction/index', $data);
		$this->load->view('layout/admin/footer');
	}
}
