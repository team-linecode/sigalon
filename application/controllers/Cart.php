<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        check_login();
        guard(['Admin', 'Customer']);
        $this->load->model('Cart_model', 'Cart');
        $this->load->model('User_model', 'User');
    }

    public function index()
    {
        if ($this->User->carts()->num_rows() == 0) {
            $this->session->set_flashdata('error', 'Keranjang kosong, Silahkan pilih produk.');
            redirect('product/list');
        }

        $data['title'] = 'Keranjang';
        $data['carts'] = $this->User->carts()->result();
        $data['payment_methods'] = $this->db->get('payment_methods')->result();

        $this->load->view('layout/admin/header', $data);
        $this->load->view('admin/cart/index', $data);
        $this->load->view('layout/admin/footer');
    }

    public function add($product_id)
    {
        if ($this->Cart->add($product_id)) {
            $this->session->set_flashdata('success', 'Produk ditambahkan ke keranjang');
            redirect('/product/list');
        }
    }

    public function update()
    {
        $cart_id = $this->input->post('cart_id');
        $qty = $this->input->post('qty');
        if ($this->Cart->update($cart_id, $qty)) {
            $this->session->set_flashdata('success', 'Produk diupdate');
            redirect('/cart');
        }
    }

    public function delete($cart_id)
    {
        if ($this->Cart->delete($cart_id)) {
            $this->session->set_flashdata('success', 'Produk dihapus');
            redirect('/cart');
        }
    }

    public function checkout()
    {
        $this->form_validation->set_rules('delivery_method', 'Delivery Method', 'required');
        $this->form_validation->set_rules('payment_method', 'Payment Method', 'required');

        if ($this->form_validation->run() == FALSE) {
            redirect('cart');
        } else {
            $no_invoice = rand(111111, 999999);
            $status = 'Unpaid';

            $data = [
                'no_invoice' => $no_invoice,
                'id_user' => user()->id,
                'id_payment_method' => $this->input->post('payment_method'),
                'date' => date('Y-m-d H:i:s'),
                'delivery_method' => $this->input->post('delivery_method'),
                'status' => $status,
                'type' => 'out'
            ];

            $this->db->insert('transactions', $data);
            $trx_id = $this->db->insert_id();
            foreach ($this->User->carts()->result() as $cart) {
                $this->db->insert('transaction_products', [
                    'id_transaction' => $trx_id,
                    'id_product' => $cart->id_product,
                    'price' => $cart->product_price,
                    'qty' => $qty = $cart->qty,
                    'total' => $total = ($cart->product_price * $cart->qty),
                    'income' => ($total - $cart->unit_price * $qty),
                ]);
            }

            $this->db->where('id_user', user()->id);
            $this->db->delete('carts');

            $this->session->set_flashdata('success', 'Transaksi berhasil dibuat');
            redirect('transaction/invoice/' . $no_invoice);
        }
    }
}
