<?php
class Employee extends CI_Model {
	public $name;
	public $role;
	public $email;
	public $telephone;
	public $password;
	
	public function insert_entry()
	{
		$this->name = $this->input->post('name');
		$this->role = $this->input->post('role');
		$this->email = $this->input->post('email');
		$this->telephone = $this->input->post('telephone');
		$this->password = $this->input->post('pwd');
		
		$this->db->insert('employees', $this);

    }
	
	public function get_employees($id = FALSE)
	{
        if ($id === FALSE)
        {
                $query = $this->db->get('employees');
                return $query->result_array();
        }

        $query = $this->db->get_where('employees', array('EmployeeId' => $id));
		$this->db->reset_query();
        return $query->row_array();
	}
	
	public function get_a_employee()
	{
		$userRole = $this->input->post('role');
        $userId = $this->input->post('userid');
		$pwd = $this->input->post('pwd');
		$sql = "SELECT * FROM employees WHERE Email = ? AND Password = ? AND Role = ?";		
        $query = $this->db->query($sql, array($userId, $pwd, $userRole));
        return $query->row_array();
	}
	
	public function edit_employee() 
	{
		$id = $this->input->post('id');
		
		$this->name = $this->input->post('name');
		$this->role = $this->input->post('role');
		$this->email = $this->input->post('email');
		$this->telephone = $this->input->post('telephone');
		$this->password = $this->input->post('pwd');
			
		$this->db->where('EmployeeId', $id);
		$sql_stmt2 = $this->db->update('employees', $this);
		$this->db->reset_query();
		if($sql_stmt2 === true) {
			return true; 
		} else {
			return false;
		}	
	}
	
	public function delete_employee($id = null) {
		if($id) {
			$sql_stmt = "DELETE FROM employees WHERE EmployeeId = ?";
			$query = $this->db->query($sql_stmt, array($id));

			// ternary operator
			return ($query === true) ? true : false;			
		} // /if
	}
}
