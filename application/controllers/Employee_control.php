<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_control extends CI_Controller {
	
	public function index()
	{
		
	}
	public function add_employee()
	{
		$this->load->model('employee');
		//$data['title'] = 'Create a news item';

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('role', 'User Role', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('telephone', 'telephone', 'required');
		$this->form_validation->set_rules('pwd', 'password', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templete/header');
			$this->load->view('templete/site_nav');
			$this->load->view('bootstrap/div_row_open');
			$this->load->view('admin_content/admin_sidebar');
			$this->load->view('admin_content/emp_rag_form');
			$this->load->view('bootstrap/div_close');
			$this->load->view('templete/footer');
		}
		else
		{
			$this->employee->insert_entry();			
			redirect('admin_page/employee_crud', 'refresh');
		}
	}
	
	public function fetch_employee_data() 
	{
		$this->load->model('employee');
		$result = array('data' => array());

		$data = $this->employee->get_employees();
		foreach ($data as $oneRec) {
			// button
			$buttons = '
			  <div class="btn-group">
				<button type="button" class="btn btn-primary" onclick="editEmployee('.$oneRec['EmployeeId'].')" data-toggle="modal" data-target="#editEmployee">Edit</button>
				<button type="button" class="btn btn-danger" onclick="deleteEmployee('.$oneRec['EmployeeId'].')" data-toggle="modal" data-target="#deleteEmployee">Delete</button>
			  </div>
			';
			
			$result['data'][] = array(
				$oneRec['Name'],
				$oneRec['Role'],
				$oneRec['Email'],
				$oneRec['Telephone'],
				$oneRec['Password'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}
	
	public function get_selected_employee($id) 
	{
		$this->load->model('employee');
		if($id) {
			$data = $this->employee->get_employees($id);
			echo json_encode($data);
		}
	}
	
	public function edit_employee() 
	{
		$validator = array('success' => false, 'messages' => array());
		
		$this->load->model('employee');
		//$data['title'] = 'Create a news item';

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('role', 'User Role', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('telephone', 'telephone', 'required');
		$this->form_validation->set_rules('pwd', 'password', 'required');
		
		
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {
			$editEmployee = $this->employee->edit_employee();			
			
			if($editEmployee === true) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully updated";
			} else {
				$validator['success'] = false;
				$validator['messages'] = "Error while updating the infromation";
			}			
		} 
		else {
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);	
			}			
		}
		
		echo json_encode($validator);
		//redirect('admin_page/category_crud', 'refresh');
	}
	
	public function delete_employee($id = null)
	{
		$this->load->model('employee');
		if($id) {
			$validator = array('success' => false, 'messages' => array());

			$deleteEmployee = $this->employee->delete_employee($id);
			if($deleteEmployee === true) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully removed";
			}
			else {
				$validator['success'] = false;
				$validator['messages'] = "Successfully removed";
			}

			echo json_encode($validator);
		}
	}
}
