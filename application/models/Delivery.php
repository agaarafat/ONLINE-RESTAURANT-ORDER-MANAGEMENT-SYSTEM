<?php
class Delivery extends CI_Model {
	public $customerid;
	public $orderid;
	public $deliverytime;
	public $deliverymanid;
	public $status;
	
	public function insert_entry()
	{
		$this->customerid = intval($this->input->post('cid'));
		$this->orderid = intval($this->input->post('oid'));
		$this->deliverytime = date('h:i:sa', strtotime("+40 minutes", time()));;
		$this->deliverymanid = intval($this->input->post('person'));
		$this->status = 'Delivering';
		
		$this->db->insert('deliveries', $this);
    }
	
	public function get_deliveries()
	{
        $this->db->select('d.DeliveryId, d.CustomerId, c.FirstName, c.LastName, c.Address1, c.Address2, c.City, c.Province, c.Postcode, c.Country, c.Email, c.Telephone, d.DeliveryManId, e.Name, d.OrderId, d.Status')
			  ->from('deliveries as d, customers as c, employees as e')
			  ->where('d.CustomerId=c.CustomerId')		
			  ->where('d.DeliveryManId=e.EmployeeId');	
        $query = $this->db->get();
			
		$this->db->reset_query();
		$this->db->reset_query();
        return $query->result_array();
	}
	
	public function update_status($oid = null, $status = 'Delivered')
	{
		$sql_stmt = 'UPDATE deliveries SET Status = ?  WHERE OrderId = ?'; 
        $query = $this->db->query($sql_stmt, array($status, $oid));
		
		$this->db->reset_query();
	}	
}
