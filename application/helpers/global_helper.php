<?php
function check_login()
{
	$ci = &get_instance();
}

function site()
{
	$ci = &get_instance();
	return $ci->db->get('sites')->row();
}
