<?php
class Pickup extends CI_Model {
	public $customerid;
	public $orderid;
	public $pickuptime;
	public $status;
	
	public function insert_entry()
	{
		$this->customerid = $this->input->post('cid');
		$this->orderid = $this->input->post('oid');
		$this->pickuptime = date('h:i:sa');
		$this->status = 'Received';
		
		$this->db->insert('pickups', $this);

    }
	
	public function get_pickups()
	{
        $this->db->select('p.PickupId, p.CustomerId, c.FirstName, c.LastName, c.Email, c.Telephone, p.OrderId, p.Status')
			  ->from('pickups as p, customers as c')
			  ->where('p.CustomerId=c.CustomerId');	
        $query = $this->db->get();
			
		$this->db->reset_query();
		$this->db->reset_query();
        return $query->result_array();
	}
}
