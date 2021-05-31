<?php

class Transaction_model extends CI_Model
{
	public function get_where($column = null, $data = null)
	{
		$trx = $this->db->query("SELECT *,
		trx.id as trx_id,
		trx.status as trx_status,
		trx.type as trx_type,
		usr.name as user_name,
		usr.phone as user_phone,
		usr.address as user_address,
		spl.phone as supplier_phone,
		spl.address as supplier_address,
		spl.price as supplier_price,
		spl.stock as supplier_stock,
		pm.type as method_type,
		pm.name as method_name
		FROM transactions trx
		LEFT JOIN users usr ON trx.id_user=usr.id
		LEFT JOIN suppliers spl ON trx.id_supplier=spl.id
		LEFT JOIN payment_methods pm ON trx.id_payment_method=pm.id
		WHERE $column = $data ORDER BY trx.id DESC");

		return $trx;
	}
}
