<?php
class Order extends CI_Model {
	public $location;
	public $customerid;
	public $status;
	public $type;
	public $orderdate;
	public $readytime;
	public $paymentid;
	public $totalamount;
	public $tps;
	public $tvq;
	public $extrafee;
	public $commant;
	
	public function insert_entry($pid = null)
	{		
		$this->location = $this->input->post('location');
		$this->customerid = $this->session->userdata('user_id');
		$this->status = "Pending";
		$this->type = $this->input->post('ordertype');
		$this->orderdate = date('Y-m-d');
		$this->readytime = date('h:i:sa', strtotime("+20 minutes", time()));
		$this->paymentid = $pid;
		$this->totalamount = $this->cart->total();
		$this->tps = $this->cart->tps_total();
		$this->tvq = $this->cart->tvq_total();
		$this->extrafee = $this->input->post('fee');
		$this->commant = $this->input->post('comment');
		
		$this->db->insert('orders', $this);
		return $this->db->insert_id();

    }
	
	public function get_orders_by_cid($cid = FALSE)
	{
        $query = $this->db->get_where('orders', array('CustomerId' => $cid));
        return $query->result_array();
	}
	
	public function get_orders($id = FALSE)
	{
        $this->db->select('o.OrderId, o.Location, o.CustomerId, c.FirstName, c.LastName, c.Address1, c.Address2, c.City, c.Province, c.Postcode, c.Country, c.Email, c.Telephone, o.Status, o.Type, o.OrderDate, o.ReadyTime, o.PaymentId, o.TotalAmount, o.TPS, o.TVQ, o.Commant')
			  ->from('orders as o, customers as c')
			  ->where('o.CustomerId=c.CustomerId');		
			  
        if ($id === FALSE)
        {			
			$query = $this->db->get();
			
			$this->db->reset_query();
            return $query->result_array();
        }
		
		$sql_stmt = 'SELECT o.OrderId, o.Location, o.CustomerId, c.FirstName, c.LastName, c.Address1, c.Address2, c.City, c.Province, c.Postcode, c.Country, c.Email, c.Telephone, o.Status, o.Type, o.OrderDate, o.ReadyTime, o.PaymentId, o.TotalAmount, o.TPS, o.TVQ, o.Commant FROM orders as o, customers as c WHERE o.CustomerId=c.CustomerId AND o.OrderId = ?'; 
        $query = $this->db->query($sql_stmt, array($id));
		
		$this->db->reset_query();
        return $query->row_array();
	}
	
	public function update_status($oid= null, $status = 'Pending')
	{
		$sql_stmt = 'UPDATE orders SET Status = ?  WHERE OrderId = ?'; 
        $query = $this->db->query($sql_stmt, array($status, $oid));
		
		$this->db->reset_query();
	}
	
	public function cancel_order($oid= null)
	{
		$sql_stmt = 'UPDATE orders SET TotalAmount = 0, TPS = 0, TVQ = 0 WHERE OrderId = ?'; 
        $query = $this->db->query($sql_stmt, array($oid));
		
		$this->db->reset_query();
	}
	public function delete_customer($id = null) {
		if($id) {
			$sql_stmt = "DELETE FROM customers WHERE CustomerId = ?";
			$query = $this->db->query($sql_stmt, array($id));

			// ternary operator
			return ($query === true) ? true : false;			
		} // /if
	}
}
