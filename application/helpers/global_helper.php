<?php

use App\Models\ArticleCategory;

function check_login()
{
	$ci = &get_instance();
	if (is_null($ci->session->userdata('login'))) {
		$ci->session->set_flashdata('error', 'Login terlebih dahulu');
		redirect('/');
	} else {
		return true;
	}
}

function guard($level = null)
{
	$ci = &get_instance();
	$user_level = user()->level;

	if (!is_null($level)) {
		if (is_array($level)) {
			if (!in_array($user_level, $level)) {
				$ci->session->set_flashdata('error', 'Tidak memiliki akses ke halaman');
				if (isset($_SERVER['HTTP_REFERER'])) {
					redirect($_SERVER['HTTP_REFERER']);
				} else {
					if (user()->level == 'Admin') {
						redirect('/dashboard');
					} else {
						redirect('/order');
					}
				}
			}
		} else {
			if ($user_level != $level) {
				$ci->session->set_flashdata('error', 'Tidak memiliki akses ke halaman');
				if (isset($_SERVER['HTTP_REFERER'])) {
					redirect($_SERVER['HTTP_REFERER']);
				} else {
					if (user()->level == 'Admin') {
						redirect('/dashboard');
					} else {
						redirect('/order');
					}
				}
			}
		}
	} else {
		$ci->session->set_flashdata('error', 'Tidak memiliki akses ke halaman');
		redirect('/');
	}
}

function user()
{
	$ci = &get_instance();
	if (check_login()) {
		$ci->db->select('id, name, username, level, phone, address');
		return $ci->db->get_where('users', ['id' => $ci->session->userdata('id_user')])->row();
	} else {
		redirect('/');
	}
}

function site()
{
	$ci = &get_instance();
	return $ci->db->get('sites')->row();
}
