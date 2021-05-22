<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Site extends CI_Controller
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
        $data['title'] = 'Data Website';
        $data['site'] = $this->db->get('sites')->result();
        $this->load->view('layout/admin/header', $data);
        $this->load->view('admin/site/index');
        $this->load->view('layout/admin/footer');
    }

    public function edit($id)
    {
        $company_name = $this->input->post('company_name');
        $company_address = $this->input->post('company_address');
        $email = $this->input->post('email');
        $whatsapp = $this->input->post('whatsapp');
        $phone = $this->input->post('phone');
        $facebook = $this->input->post('facebook');
        $instagram = $this->input->post('instagram');
        $line = $this->input->post('line');

        $data['site'] = $this->db->get_where('sites', ['id' => $id])->row();
        $data['title'] = 'Ubah Data Website';
        $this->load->view('layout/admin/header', $data);
        $this->load->view('admin/site/edit');
        $this->load->view('layout/admin/footer');

        if ($_POST) {
            $data = [
                'company_name' => $company_name,
                'company_address' => $company_address,
                'email' => $email,
                'whatsapp' => $whatsapp,
                'phone' => $phone,
                'facebook' => $facebook,
                'instagram' => $instagram,
                'line' => $line
            ];

            $this->db->where('id', $id);
            $this->db->update('sites', $data);

            $this->session->set_flashdata('success', 'Data Website berhasil diubah');
            redirect('site/index');
        }
    }
}
