<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
{
    public function index()
    {
        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $contact = $this->input->post('contact');
        $phone = $this->input->post('phone');
        $price = $this->input->post('price');
        $liter = $this->input->post('liter');
        $liter_galon = 19;
        
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('contact', 'Contact', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('liter', 'Liter', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Supplier';
            $data['suppliers'] = $this->db->get('suppliers')->result();
            $this->load->view('layout/admin/header', $data);
            $this->load->view('admin/supplier/index');
            $this->load->view('layout/admin/footer');
        } else {
            $stok = floor($liter / $liter_galon);
            $unit_price = floor($price / $stok);
            $data = [
				'name' => $name,
				'address' => $address,
				'contact' => $contact,
				'phone' => $phone,
				'price' => $price,
				'liter' => $liter,
				'stok' => $stok,
				'unit_price' => $unit_price 
			];
			
			$this->db->insert('suppliers', $data);
			redirect('supplier/index');
        }
    }
    
    public function edit($id)
    {
        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $contact = $this->input->post('contact');
        $phone = $this->input->post('phone');
        $price = $this->input->post('price');
        $liter = $this->input->post('liter');
        $liter_galon = 19;
        
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('contact', 'Contact', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('liter', 'Liter', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Supplier';
            $data['suppliers'] = $this->db->get_where('suppliers', ['id'=>$id])->row();
            $this->load->view('layout/admin/header', $data);
            $this->load->view('admin/supplier/edit');
            $this->load->view('layout/admin/footer');
        } else {
            $stok = floor($liter / $liter_galon);
            $unit_price = floor($price / $stok);
            $data = [
				'name' => $name,
				'address' => $address,
				'contact' => $contact,
				'phone' => $phone,
				'price' => $price,
				'liter' => $liter,
				'stok' => $stok,
				'unit_price' => $unit_price 
			];
			
			$this->db->update('suppliers', $data);
			redirect('supplier/index');
        }
    }

    public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('suppliers');
		redirect('supplier/index');
	}
}
