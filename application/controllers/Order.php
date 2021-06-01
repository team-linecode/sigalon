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
