<?php

function check_login()
{
	$ci = &get_instance();

	if ($ci->session->userdata('login') == TRUE) {
		return true;
	} else {
		return false;
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
