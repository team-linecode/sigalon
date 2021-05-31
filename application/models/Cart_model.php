<?php

class Cart_model extends CI_Model
{
	public function add($product_id)
	{
		$user_id = user()->id;
		$cart = $this->db->query("SELECT * FROM carts WHERE id_user='$user_id' AND id_product='$product_id'")->row();

		if (is_null($cart)) {
			$this->db->insert('carts', [
				'id_product' => $product_id,
				'id_user' => $user_id,
				'qty' => 1
			]);
		} else {
			$plus_qty = $cart->qty + 1;
			$this->db->set('qty', $plus_qty);
			$this->db->where('id', $cart->id);
			$this->db->update('carts');
		}
		return true;
	}

	public function update($cart_id, $qty)
	{
		$this->db->set('qty', $qty);
		$this->db->where('id', $cart_id);
		return $this->db->update('carts');
	}

	public function delete($cart_id)
	{
		$this->db->where('id', $cart_id);
		return $this->db->delete('carts');
	}
}
