<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
    }

    public function index()
    {
        guard('Admin');

        $name = $this->input->post('name');
        $price = $this->input->post('price');
        $id_supplier = $this->input->post('id_supplier');

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('id_supplier', 'Suppliers', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Barang';
            $data['products'] = $this->db->query("SELECT *,
            suppliers.name as supplier_name,
            products.name as product_name,
            products.price as product_price,
            products.id as product_id,
            products.stock as product_stock
            FROM products
            JOIN suppliers ON products.id_supplier = suppliers.id
            WHERE products.deleted_at IS NULL")->result();
            $data['suppliers'] = $this->db->get('suppliers')->result();

            $this->load->view('layout/admin/header', $data);
            $this->load->view('admin/product/index');
            $this->load->view('layout/admin/footer');
        } else {
            $config['upload_path'] = './assets/img/product/';
            $config['file_name'] = rand(111111, 999999);
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size'] = 2048;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('product_image')) {
                $error = ['error' => $this->upload->display_errors()];
                $this->session->set_flashdata('error', $error);
                redirect('product/index');
            }

            $data = [
                'name' => $name,
                'id_supplier' => $id_supplier,
                'price' => $price,
                'status' => 'Active',
                'image' => $this->upload->data("file_name")
            ];

            $this->db->insert('products', $data);
            $this->session->set_flashdata('success', 'Data Barang berhasil ditambahkan');
            redirect('product/index');
        }
    }

    public function edit($id)
    {
        guard('Admin');

        $data['products'] = $this->db->query("SELECT *, suppliers.name as supplier_name, products.name as product_name, products.price as product_price, products.id as product_id FROM products JOIN suppliers ON products.id_supplier = suppliers.id WHERE products.id = '$id'")->row();
        $name = $this->input->post('name');
        $id_supplier = $this->input->post('id_supplier');
        $price = $this->input->post('price');
        $status = $this->input->post('status');

        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('id_supplier', 'Supplier', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Edit Barang';
            $data['suppliers'] = $this->db->get('suppliers')->result();
            $this->load->view('layout/admin/header', $data);
            $this->load->view('admin/product/edit');
            $this->load->view('layout/admin/footer');
        } else {
            if (!empty($_FILES['product_image']['name'])) {
                $config['upload_path'] = './assets/img/product/';
                $config['file_name'] = rand(111111, 999999);
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size'] = 2048;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('product_image')) {
                    $error = ['error' => $this->upload->display_errors()];
                    $this->session->set_flashdata('error', $error);
                    redirect('product/index');
                } else {
                    unlink('./assets/img/product/' . $data['products']->image);
                    $filename = $this->upload->data("file_name");
                }
            }

            $data = [
                'name' => $name,
                'id_supplier' => $id_supplier,
                'status' => $status,
                'price' => $price,
                'image' => isset($filename) ? $filename : $data['product']->image
            ];

            $this->db->where('id', $id);
            $this->db->update('products', $data);

            $this->session->set_flashdata('success', 'Data Barang berhasil diubah');
            redirect('product');
        }
    }

    public function delete($id)
    {
        guard('Admin');

        $this->db->set('deleted_at', date('Y-m-d H:i:s'));
        $this->db->where('id', $id);
        $this->db->update('products');

        $this->session->set_flashdata('success', 'Data Barang berhasil dihapus');
        redirect('product');
    }

    public function get_supplier($id)
    {
        guard('Admin');

        $supplier = $this->db->get_where('suppliers', ['id' => $id])->row();
        $supplier->price = number_format($supplier->price);
        $supplier->liter = number_format($supplier->liter);
        $supplier->stock = number_format($supplier->stock);
        $supplier->unit_price = number_format($supplier->unit_price);
        header('Content-Type: application/json');
        echo json_encode($supplier);
    }

    public function list()
    {
        guard('Customer');

        $data['title'] = 'Produk';
        $data['products'] = $this->db->get_where('products', ['deleted_at' => null])->result();

        $this->load->view('layout/admin/header', $data);
        $this->load->view('admin/product/list');
        $this->load->view('layout/admin/footer');
    }
}
