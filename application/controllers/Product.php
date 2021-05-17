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
            $data['products'] = $this->db->select('*')->from('products')->join('suppliers', 'products.id_supplier = suppliers.id')->get()->result();
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
            var_dump($data);
            
            $this->db->insert('products', $data);
            redirect('product/index');
        }
    }

    public function edit($id)
    {
        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $price = $this->input->post('price');

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Supplier';
            $data['suppliers'] = $this->db->get_where('suppliers', ['id' => $id])->row();
            $this->load->view('layout/admin/header', $data);
            $this->load->view('admin/supplier/edit');
            $this->load->view('layout/admin/footer');
        } else {
            $data = [
                'name' => $name,
                'address' => $address,
                'price' => $price
            ];

            $this->db->update('suppliers', $data);
            redirect('supplier');
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('suppliers');
        redirect('supplier');
    }

    public function get_supplier()
    {
        echo '<div class="col-lg-4">
                <div class="form-group">
                    <label for="">Nomor Hanphone</label>
                    <input type="number" class="form-control" name="phone" id="phone">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="">Price/Tanki</label>
                    <input type="number" class="form-control" name="price" id="price">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label for="">Liter/Tanki</label>
                    <input type="number" class="form-control" name="liter" id="liter">
                </div>
            </div>';
    }
}
