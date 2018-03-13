<?php
class Payment extends CI_Model {
	public $paymenttype;
	public $description;
	public $paymentamount;
	public $customerid;
	public $orderid;
	
	public function insert_entry($oid = 9999)
	{
		$this->paymenttype = $this->input->post('paymenttype');
		
		$desc = $this->input->post('cnumber').'|'.$this->input->post('code').'|'.$this->input->post('month').'|'.$this->input->post('year').'|'.$this->input->post('name');
		
		$this->description = $desc;
		$this->paymentamount = $this->input->post('totalamount');
		$this->customerid = $this->session->userdata('user_id');
		$this->orderid = $oid;
		
		$this->db->insert('payments', $this);
		return $this->db->insert_id();

    }
	
	public function update_oid($id=null, $oid = null)
	{
		$data=array('OrderId'=>$oid);
		$this->db->where('PaymentId', $id);
		$sql_stmt = $this->db->update('payments', $data);
		if($sql_stmt === true) {
			return true; 
		} else {
			return false;
		}

    }
	
	public function return_money($oid= null)
	{
		$sql_stmt = 'UPDATE payments SET PaymentAmount = 0 , Description = "Back Money to client"  WHERE OrderId = ?'; 
        $query = $this->db->query($sql_stmt, array($oid));
		
		$this->db->reset_query();
	}	
}
