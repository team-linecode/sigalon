<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment_Method extends CI_Controller
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
		$name = $this->input->post('name');
		$type = $this->input->post('type');
		$acc_number = $this->input->post('acc_number');
		$acc_name = $this->input->post('acc_name');
		
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('type', 'Type', 'required');
		if($type == 'transfer'){
			$this->form_validation->set_rules('acc_number', 'Account Number', 'required');
			$this->form_validation->set_rules('acc_name', 'Account Name', 'required');
		}

		if ($this->form_validation->run() == FALSE){

			$data['title'] = 'Metode Pembayaran';
			$data['method'] = $this->db->get('payment_methods')->result();
			$this->load->view('layout/admin/header', $data);
			$this->load->view('admin/payment_method/index');
			$this->load->view('layout/admin/footer');
		} else {
			$data = [
				'name' => $name,
				'type' => $type,
				'acc_number' => $acc_number,
				'acc_name' => $acc_name,
				'status' => 'Active' 
			];
			
			$this->db->insert('payment_methods', $data);

			$this->session->set_flashdata('success', 'Metode Pembayaran berhasil dibuat');
			redirect('payment_method/index');
		}
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('payment_methods');
		$this->session->set_flashdata('success', 'Data Barang berhasil dihapus');
		redirect('payment_method/index');
	}

	public function edit($id)
	{
		
		$name = $this->input->post('name');
		$type = $this->input->post('type');
		$acc_number = $this->input->post('acc_number');
		$acc_name = $this->input->post('acc_name');
		$status = $this->input->post('status');
		
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('type', 'Type', 'required');

		if($type == 'transfer'){
			$this->form_validation->set_rules('acc_number', 'Account Number', 'required');
			$this->form_validation->set_rules('acc_name', 'Account Name', 'required');
		}
		
		if ($this->form_validation->run() == FALSE){
			$data['method'] = $this->db->get_where('payment_methods', ['id'=>$id])->row();
			$data['title'] = 'Metode Pembayaran';
			$this->load->view('layout/admin/header', $data);
			$this->load->view('admin/payment_method/edit');
			$this->load->view('layout/admin/footer');
		} else {
			$data = [
				'name' => $name,
				'type' => $type,
				'acc_number' => $acc_number,
				'acc_name' => $acc_name,
				'status' => $status 
			];
			
			$this->db->where('id', $id);
			$this->db->update('payment_methods', $data);

			$this->session->set_flashdata('success', 'Metode Pembayaran berhasil diubah');
			redirect('payment_method/index');
		}
	}

}
