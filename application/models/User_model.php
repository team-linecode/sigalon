<?php

class User_model extends CI_Model
{
	public function carts()
	{
		$user_id = user()->id;
		return $this->db->query("SELECT *,
		c.id as id_cart,
		p.id as id_product,
		p.name as product_name,
		p.price as product_price
		FROM carts c
		JOIN products p ON c.id_product = p.id
		JOIN suppliers spl ON p.id_supplier = spl.id
		WHERE id_user='$user_id'");
	}
}
