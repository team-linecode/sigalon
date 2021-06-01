<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaction extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_login();
		$this->load->model('Transaction_model', 'Transaction');
	}

	public function index()
	{
		guard(['Admin', 'Customer']);

		$data['title'] = 'Transaksi';
		$data['transactions'] = $this->Transaction->get_where()->result();

		$this->load->view('layout/admin/header', $data);
		$this->load->view('admin/transaction/index', $data);
		$this->load->view('layout/admin/footer');
	}

	public function create()
	{
		guard('Admin');

		$this->form_validation->set_rules('supplier', 'Supplier', 'required');
		$this->form_validation->set_rules('product', 'Product', 'required');
		$this->form_validation->set_rules('delivery_method', 'Delivery Method', 'required');

		if ($this->input->post('type') == 'out') {
			$this->form_validation->set_rules('payment_method', 'Payment Method', 'required');
			$this->form_validation->set_rules('qty', 'Quantity', 'required');
		}

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Transaksi Baru';
			$data['transactions'] = $this->Transaction->get_where()->result();
			$data['payment_methods'] = $this->db->get('payment_methods')->result();
			$data['suppliers'] = $this->db->get('suppliers')->result();

			$this->load->view('layout/admin/header', $data);
			$this->load->view('admin/transaction/create', $data);
			$this->load->view('layout/admin/footer');
		} else {
			$id_product = $this->input->post('product');

			$product = $this->db->query("SELECT *,
			p.price as p_price,
			spl.price as spl_price
			FROM products p
			JOIN suppliers spl
			ON p.id_supplier = spl.id
			WHERE p.id='$id_product'")->row();

			$no_invoice = rand(111111, 999999);
			$status = 'Unpaid';

			$data = [
				'no_invoice' => $no_invoice,
				'id_supplier' => $this->input->post('supplier'),
				'id_payment_method' => empty($this->input->post('payment_method')) ? null : $this->input->post('payment_method'),
				'date' => date('Y-m-d H:i:s'),
				'delivery_method' => $this->input->post('delivery_method'),
				'status' => $status,
				'type' => 'in'
			];

			$this->db->insert('transactions', $data);

			$trx_id = $this->db->insert_id();
			$this->db->insert('transaction_products', [
				'id_transaction' => $trx_id,
				'id_product' => $id_product,
				'price' => $product->spl_price
			]);

			$this->session->set_flashdata('success', 'Transaksi berhasil dibuat');
			redirect('transaction');
		}
	}

	public function change_status($id, $status)
	{
		guard('Admin');

		$trx = $this->Transaction->get_where('trx.id', $id)->row();

		if ($status == 'Paid') {
			foreach ($this->Transaction->products($trx->trx_id)->result() as $product) {
				$p = $this->db->get_where('products', ['id' => $product->product_id])->row();
				if ($trx->trx_type == 'out') {
					$stock = ($p->stock - $product->qty);
				} else {
					$stock = ($p->stock + $trx->supplier_stock);
				}
				
				$this->db->set('stock', $stock);
				$this->db->where('id', $product->product_id);
				$this->db->update('products');
			}

			$this->db->set('paid_at', date('Y-m-d H:i:s'));
		} else if ($status == 'Canceled') {
			$this->db->set('canceled_at', date('Y-m-d H:i:s'));
		} else if ($status == 'On_Process') {
			$this->db->set('process_at', date('Y-m-d H:i:s'));
			$status = 'On Process';
		} else if ($status == 'Completed') {
			if ($trx->process_at == null) {
				$this->db->set('process_at', date('Y-m-d H:i:s'));
			}
			$this->db->set('completed_at', date('Y-m-d H:i:s'));
		}

		$this->db->set('status', $status);
		$this->db->where('id', $id);
		$this->db->update('transactions');

		redirect('transaction');
	}

	public function get_product($id)
	{
		guard('Admin');

		$product = $this->db->query("SELECT *, suppliers.name as supplier_name, suppliers.price as supplier_price, products.name as product_name, products.price as product_price, products.stock as product_stock, suppliers.stock as supplier_stock FROM products JOIN suppliers ON products.id_supplier = suppliers.id WHERE products.id = '$id'")->row();
		$product->product_price = number_format($product->product_price);
		$product->product_stock = number_format($product->product_stock);
		$product->supplier_price = 'Rp ' . number_format($product->supplier_price);
		$product->supplier_stock = number_format($product->supplier_stock, 0, '.', '.');
		$product->liter = number_format($product->liter, 0, '.', '.');
		header('Content-Type: application/json');
		echo json_encode($product);
	}

	public function calculate_price($product_id, $qty)
	{
		guard('Admin');

		$product = $this->db->query("SELECT price FROM products WHERE id = '$product_id'")->row();
		$total = $product->price * $qty;
		header('Content-Type: application/json');
		echo json_encode(number_format($total));
	}

	public function get_payment_method($id)
	{
		guard('Admin');

		$payment_method = $this->db->get_where('payment_methods', ['id' => $id])->row();
		header('Content-Type: application/json');
		echo json_encode($payment_method);
	}

	public function get_user($type)
	{
		guard('Admin');
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

	public function get_supplier_product($id_supplier)
	{
		guard('Admin');

		$products = $this->db->get_where('products', ['id_supplier' => $id_supplier])->result();

		$attr = '<option hidden>Pilih Produk</option>';
		if (count($products) < 1) {
			$attr .= '<option disabled>Tidak ada data.</option>';
		} else {
			foreach ($products as $product) {
				$attr .= '<option value="' . $product->id . '">' . $product->name . '</option>';
			}
		}

		echo $attr;
	}

	public function invoice($no_invoice)
	{
		guard(['Admin', 'Customer']);
		$data['trx'] = $this->Transaction->get_where('no_invoice', $no_invoice)->row();
		$id_transaction = $data['trx']->trx_id;
		$data['trx_products'] = $this->Transaction->products($id_transaction)->result();
		// var_dump($data['trx_products']); die;
		$data['title'] = 'Invoice';

		$data['total'] = 0;
		foreach ($data['trx_products'] as $product) {
			$data['total'] += ($product->product_price * $product->qty);
		}

		$this->load->view('layout/admin/header', $data);
		$this->load->view('admin/transaction/invoice', $data);
		$this->load->view('layout/admin/footer');
	}

	public function print($no_invoice)
	{
		guard(['Admin', 'Customer']);
		$data['trx'] = $this->Transaction->get_where('no_invoice', $no_invoice)->row();
		$id_transaction = $data['trx']->trx_id;
		$data['trx_products'] = $this->Transaction->products($id_transaction)->result();

		$data['total'] = 0;
		foreach ($data['trx_products'] as $product) {
			$data['total'] += ($product->product_price * $product->qty);
		}

		echo $this->load->view('admin/transaction/print', $data, TRUE);
	}
}
