<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
    public function index()
    {
        $name = $this->input->post('name');
        $price = $this->input->post('price');
        $id_supplier = $this->input->post('id_supplier');
        
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('id_supplier', 'Suppliers', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Barang';
            $data['products'] = $this->db->query('SELECT *, suppliers.name as supplier_name, products.name as product_name, products.price as product_price, products.id as product_id FROM products JOIN suppliers ON products.id_supplier = suppliers.id')->result();
            $data['suppliers'] = $this->db->get('suppliers')->result();
            $this->load->view('layout/admin/header', $data);
            $this->load->view('admin/product/index');
            $this->load->view('layout/admin/footer');
        } else {
            $data = [
                'name' => $name,
                'id_supplier' => $id_supplier,
                'price' => $price,
                'status' => 'Active'
            ];
            
            $this->db->insert('products', $data);
            redirect('product/index');
        }
    }

    public function edit($id)
    {
        $name = $this->input->post('name');
        $id_supplier = $this->input->post('id_supplier');
        $price = $this->input->post('price');
        $status = $this->input->post('status');

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('id_supplier', 'Supplier', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Supplier';
            $data['products'] = $this->db->get_where('products', ['id' => $id])->row();
            $data['suppliers'] = $this->db->get('suppliers')->result();
            $this->load->view('layout/admin/header', $data);
            $this->load->view('admin/product/edit');
            $this->load->view('layout/admin/footer');
        } else {
            $data = [
                'name' => $name,
                'id_supplier' => $id_supplier,
                'status' => $status,
                'price' => $price
            ];

            $this->db->where('id', $id);
            $this->db->update('products', $data);
            redirect('product');
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('products');
        redirect('product');
    }

    public function get_supplier($id)
    {
        $supplier = $this->db->get_where('suppliers', ['id'=> $id])->row();
		header('Content-Type: application/json');
		echo json_encode($supplier);
        var_dump($supplier);
    }
}
