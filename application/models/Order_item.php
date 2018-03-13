<?php
class Order_item extends CI_Model {
	public $name;
	public $quantity;
	public $unitprice;
	public $totalprice;
	public $orderid;
	
	public function insert_entry($oid = null)
	{
		foreach($this->cart->contents() as $items)
		{
			$this->name = $items['name'];
			$this->quantity = $items['qty'];
			$this->unitprice = $items['price'];
			$this->totalprice = $items['subtotal'];
			$this->orderid = $oid;		
			
			$this->db->insert('orderitems', $this);
		}
    }
	
	public function get_items_by_oid($oid = FALSE)
	{
        $query = $this->db->get_where('orderitems', array('OrderId' => $oid));
        return $query->result_array();
	}	
}
