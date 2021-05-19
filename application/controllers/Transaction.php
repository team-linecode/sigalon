<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{
	public function index()
	{
		$data['title'] = 'Transaksi';
		$data['transactions'] = $this->db->query('SELECT *, products.name as product_name, suppliers.name as supplier_name, users.name as user_name, transactions.status as trx_status, transactions.id as trx_id FROM transactions JOIN products ON transactions.id_product = products.id JOIN suppliers ON products.id_supplier = suppliers.id JOIN users ON transactions.id_user = users.id JOIN payment_methods ON transactions.id_payment_method = payment_methods.id')->result();
		$this->load->view('layout/admin/header', $data);
		$this->load->view('admin/transaction/index', $data);
		$this->load->view('layout/admin/footer');
	}

	public function create()
	{
		$this->form_validation->set_rules('user', 'Customer', 'required');
		$this->form_validation->set_rules('product', 'Product', 'required');
		$this->form_validation->set_rules('qty', 'Quantity', 'required');
		$this->form_validation->set_rules('payment_method', 'Payment Method', 'required');
		$this->form_validation->set_rules('delivery_method', 'Delivery Method', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Transaksi Baru';
			$data['transactions'] = $this->db->query('SELECT * FROM transactions JOIN products ON transactions.id_product = products.id JOIN users ON transactions.id_user = users.id JOIN payment_methods ON transactions.id_payment_method = payment_methods.id')->result();
			$data['payment_methods'] = $this->db->get('payment_methods')->result();
			$data['customers'] = $this->db->get_where('users', ['level' => 'Customer'])->result();

			$this->load->view('layout/admin/header', $data);
			$this->load->view('admin/transaction/create', $data);
			$this->load->view('layout/admin/footer');
		} else {
			$product = $this->db->get_where('products', ['id', $this->input->post('product')])->row();
			$no_invoice = rand(111111, 999999);
			$status = 'Unpaid';
			$total = $product->price * $this->input->post('qty');

			$data = [
				'no_invoice' => $no_invoice,
				'id_product' => $this->input->post('product'),
				'id_user' => $this->input->post('user'),
				'qty' => $this->input->post('qty'),
				'total' => $total,
				'id_payment_method' => $this->input->post('payment_method'),
				'date' => date('d-m-Y'),
				'delivery_method' => $this->input->post('delivery_method'),
				'status' => $status
			];

			$this->db->insert('transactions', $data);
			redirect('transaction');
		}
	}

	public function change_status($id, $status)
	{
		$this->db->set('status', $status);
		$this->db->where('id', $id);
		$this->db->update('transactions');

		redirect('transaction');
	}

	public function get_product($id)
	{
		$product = $this->db->query("SELECT *, suppliers.name as supplier_name, products.name as product_name, products.price as product_price FROM products JOIN suppliers ON products.id_supplier = suppliers.id WHERE products.id = '$id'")->row();
		$product->product_price = number_format($product->product_price);
		header('Content-Type: application/json');
		echo json_encode($product);
	}

	public function calculate_price($product_id, $qty)
	{
		$product = $this->db->query("SELECT price FROM products WHERE id = '$product_id'")->row();
		$total = $product->price * $qty;
		header('Content-Type: application/json');
		echo json_encode(number_format($total));
	}

	public function get_payment_method($id)
	{
		$payment_method = $this->db->get_where('payment_methods', ['id' => $id])->row();
		header('Content-Type: application/json');
		echo json_encode($payment_method);
	}

	public function get_user($type)
	{
		if ($type == 'in') {
			$type = 'Supplier';
			$users = $this->db->get('suppliers')->result();
		} else if ($type == 'out') {
			$type = 'Customer';
			$users = $this->db->get_where('users', ['level !=' => 'admin'])->result();
		}

		$attr = '<option hidden>Pilih ' . $type . '</option>';
		if (count($users) < 1) {
			$attr .= '<option disabled>Tidak ada data.</option>';
		} else {
			$attr .= '<optgroup label="' . $type . '">';
			foreach ($users as $user) {
				if ($type == 'Supplier') {
					$attr .= '<option value="' . $user->id . '">' . $user->name . '</option>';
				} else {
					$attr .= '<option value="' . $user->id . '">' . $user->name . ' (' . $user->username . ')' . '</option>';
				}
			}
			$attr .= '</optgroup>';
		}

		echo $attr;
	}

	public function get_supplier_product($id_supplier, $type)
	{
		if ($type == 'in') {
			$products = $this->db->get_where('products', ['id_supplier' => $id_supplier])->result();
		} else {
			$products = $this->db->query("SELECT *, suppliers.name as supplier_name, products.name as product_name, products.id as product_id FROM products JOIN suppliers ON products.id_supplier = suppliers.id")->result();
			$suppliers = $this->db->get('suppliers')->result();
		}

		$attr = '<option hidden>Pilih Produk</option>';
		if (count($products) < 1) {
			$attr .= '<option disabled>Tidak ada data.</option>';
		} else {
			foreach ($suppliers as $supplier) {
				if ($type == 'out') {
					$attr .= '<optgroup label="' . $supplier->name . '">';
				}
				foreach ($products as $product) {
					if ($type == 'in') {
						$attr .= '<option value="' . $product->id . '">' . $product->name . '</option>';
					} else {
						if ($supplier->id == $product->id_supplier) {
							$attr .= '<option value="' . $product->product_id . '">' . $product->product_name . '</option>';
						}
					}
				}
				if ($type == 'out') {
					$attr .= '</optgroup>';
				}
			}
		}

		echo $attr;
	}
}
