<?php
class Customer extends CI_Model {
	public $firstname;
	public $lastname;
	public $email;
	public $telephone;
	public $address1;
	public $address2;
	public $city;
	public $province;
	public $postcode;
	public $country;
	public $userid;
	public $password = "123456";
	public $status;
	
	public function insert_entry()
	{
		$this->firstname = $this->input->post('fname');
		$this->lastname = $this->input->post('lname');
		$this->email = $this->input->post('email');
		$this->telephone = $this->input->post('telephone');
		$this->address1 = $this->input->post('addr1');
		$this->address2 = $this->input->post('addr2');
		$this->city = $this->input->post('city');
		$this->province = $this->input->post('province');
		$this->postcode = $this->input->post('pcode');
		$this->country = $this->input->post('country');
		$this->userid = $this->input->post('userid');
		$this->password = $this->input->post('pwd');
		$this->status = 'Enable';
		
		if($this->userid == NULL && $this->password == NULL) {
			$this->userid = $this->input->post('email');
			$this->password = "123456";
		}
		$this->db->insert('customers', $this);

    }
	
	public function get_customers($id = FALSE)
	{
        if ($id === FALSE)
        {
                $query = $this->db->get('customers');
                return $query->result_array();
        }

        $query = $this->db->get_where('customers', array('CustomerId' => $id));
        return $query->row_array();
	}
	
	public function get_a_customer()
	{
        $userId = $this->input->post('userid');
		$pwd = $this->input->post('pwd');
		$sql = "SELECT * FROM customers WHERE ( Email = ? OR UserId = ? ) AND Password = ? AND Status = 'Enable'";		
        $query = $this->db->query($sql, array($userId, $userId, $pwd));;
        return $query->row_array();
	}
	
	public function edit_customer() 
	{
		$id = $this->input->post('id');
		
		$arr = $this->get_customers($id);
		
		$this->firstname = $this->input->post('fname');
		$this->lastname = $this->input->post('lname');
		$this->email = $this->input->post('email');
		$this->telephone = $this->input->post('telephone');
		$this->address1 = $this->input->post('addr1');
		$this->address2 = $this->input->post('addr2');
		$this->city = $this->input->post('city');
		$this->province = $this->input->post('province');
		$this->postcode = $this->input->post('pcode');
		$this->country = $this->input->post('country');
		$this->userid = $arr['UserId'];
		$this->password = $arr['Password'];
		
		if($this->input->post('userid') !== null)
		{
			$this->userid = $this->input->post('userid');
			$this->password = $this->input->post('pwd');
		}
		$this->status = 'Enable';
		
		$this->db->reset_query();
		
		$this->db->where('CustomerId', $id);
		$sql_stmt2 = $this->db->update('customers', $this);
		if($sql_stmt2 === true) {
			return true; 
		} else {
			return false;
		}	
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
