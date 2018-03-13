<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_access extends CI_Controller {
	public function index()
	{
		$this->load->view('templete/header');
		$this->load->view('templete/admin_nav');
		$this->load->view('access_content/signin_form');
		$this->load->view('templete/footer');
	}
	
	public function signin_page()
	{
		$this->load->view('templete/header');
		$this->load->view('templete/admin_nav');
		$this->load->view('access_content/signin_form');
		$this->load->view('templete/footer');
	}
	
	public function signin_user()
	{
		/*if(!$this->session->has_userdata('user_id'))
		{
			redirect(base_url());
		}*/
		$this->form_validation->set_rules('role', 'User Role', 'required');
		$this->form_validation->set_rules('userid', 'User ID', 'required');
		$this->form_validation->set_rules('pwd', 'Password', 'required');
		
		$this->load->model('employee');
		$data['users'] = $this->employee->get_a_employee();
		
		if ($this->form_validation->run() === FALSE || $data['users'] == null)
		{
			if($data['users'] == null)
				$this->session->set_userdata('error', 'Some information does not match!');
			
			$this->load->view('templete/header');
			$this->load->view('templete/admin_nav');
			$this->load->view('access_content/signin_form');
			$this->load->view('templete/footer');
		}
		else
		{
			$user_data = array (
				'user_role' => $data['users']['Role'],
				'user_id' => $data['users']['EmployeeId'],
				'user_name' => $data['users']['Name'],
				'user_email' => $data['users']['Email'],
				'user_phone' => $data['users']['Telephone']
			);
			
			$this->session->set_userdata($user_data);
			$this->session->set_userdata('message', 'Sign In Done Successfully!');
			
			if($data['users']['Role'] === 'Admin')
			{
				redirect(base_url().'admin_page', 'refresh');
			}			
			elseif($data['users']['Role'] === 'Salesman')
			{
				redirect(base_url().'employee_page', 'refresh');
			}
			elseif($data['users']['Role'] === 'Deliveryman')
			{}
			else 
			{
				echo "<h1 class='text-danger'>You are hacker! Warning: Don't try to enter again!</h1>";
			}	
			
		}
	}
	
	public function signout()
	{
		$user_data = array ('user_role','user_id', 'user_name', 'user_email', 'user_phone');
		$this->session->unset_userdata($user_data);
		$this->session->sess_destroy();
		
		$this->load->view('templete/header');
		$this->load->view('templete/admin_nav');
		$this->load->view('access_content/signin_form');
		$this->load->view('templete/footer');
	}
	
	
}
