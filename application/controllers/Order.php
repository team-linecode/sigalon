<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		check_login();
		guard('Customer');
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

	public function create()
	{
		$this->form_validation->set_rules('product', 'Product', 'required');
		$this->form_validation->set_rules('qty', 'qty', 'required');
		$this->form_validation->set_rules('payment_method', 'Payment Method', 'required');
		$this->form_validation->set_rules('delivery_method', 'Delivery Method', 'required');

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Pesanan Baru';
			$data['payment_methods'] = $this->db->get('payment_methods')->result();
			$data['customers'] = $this->db->get_where('users', ['level' => 'Customer'])->result();
			$data['products'] = $this->db->get_where('products', ['stock >' => 0])->result();

			$this->load->view('layout/admin/header', $data);
			$this->load->view('admin/order/create', $data);
			$this->load->view('layout/admin/footer');
		} else {
			$product = $this->db->get_where('products', ['id' => $this->input->post('product')])->row();
			$total = $product->price * $this->input->post('qty');
			$no_invoice = rand(111111, 999999);

			$data = [
				'no_invoice' => $no_invoice,
				'id_product' => $this->input->post('product'),
				'id_user' => $this->session->userdata('id_user'),
				'qty' => $this->input->post('qty'),
				'total' => $total,
				'id_payment_method' => $this->input->post('payment_method'),
				'date' => date('Y-m-d H:i:s'),
				'delivery_method' => $this->input->post('delivery_method'),
				'status' => 'Unpaid',
				'type' => 'out'
			];

			$this->db->insert('transactions', $data);

			$this->session->set_flashdata('alert-success', '
			<h4>Pesanan Berhasil Dibuat</h4>
			Silahkan konfirmasi pembayaran melalui whatsapp dengan menekan tombol <b>"Bayar"</b> dibawah.<br>
			<b>No Faktur</b> : #' . $no_invoice . '<br>
			<b>Jumlah yang harus dibayar</b> : Rp ' . number_format($total) . '
			');
			redirect('transaction/invoice/' . $no_invoice);
		}
	}

	public function change_status($id, $status)
	{
		$trx = $this->Transaction->get_where('trx.id', $id)->row();

		if ($status == 'Canceled') {
			$this->db->set('canceled_at', date('Y-m-d H:i:s'));
		} else {
			$this->session->set_flashdata('error', 'Gagal mengubah status');
			redirect('order');
		}

		$this->db->set('status', $status);
		$this->db->where('id', $id);
		$this->db->update('transactions');

		$this->session->set_flashdata('success', 'Pesanan berhasil dibatalkan');
		redirect('order');
	}
}
