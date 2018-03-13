<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_control extends CI_Controller {
	
	public function index()
	{
		
	}
	public function add_customer($flag = 0)
	{
		
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->database();
		$this->load->model('customer');
		//$data['title'] = 'Create a news item';

		$this->form_validation->set_rules('fname', 'First Name', 'required');
		$this->form_validation->set_rules('lname', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('telephone', 'telephone', 'required');
		$this->form_validation->set_rules('addr1', 'Address 1', 'required');
		$this->form_validation->set_rules('addr2', 'Address 2', 'required');
		$this->form_validation->set_rules('city', 'city', 'required');
		$this->form_validation->set_rules('province', 'province', 'required');
		$this->form_validation->set_rules('pcode', 'post code', 'required');
		$this->form_validation->set_rules('country', 'country', 'required');
		
		
		
		$inputCaptcha = $this->input->post('captcha');
        $sessCaptcha = $this->session->userdata('captchaCode');
		if($flag != 0)
		{
			$this->form_validation->set_rules('userid', 'user id', 'required');
			$this->form_validation->set_rules('pwd', 'password', 'required');
			$this->form_validation->set_rules('pwd2', 'password confirmation', 'required|matches[pwd]');
			
			$this->form_validation->set_rules('capans', 'Captcha Image', 'required');
			$this->form_validation->set_rules('captcha', 'Captcha', 'required|matches[capans]');            			
		}
		

		if ($this->form_validation->run() === FALSE && $flag === 0)
		{
			$this->load->view('templete/header');
			$this->load->view('templete/admin_nav');
			$this->load->view('bootstrap/div_row_open');
			$this->load->view('admin_content/admin_sidebar');
			$this->load->view('admin_content/customer_form');
			$this->load->view('bootstrap/div_close');
			$this->load->view('templete/footer');
		}
		elseif ($this->form_validation->run() === FALSE && $flag != 0)
		{
			$this->load->helper(array('form', 'captcha')); 
			$this->load->library('session');
			
			// Captcha configuration
			$config = array(
				'word'          => '',
				'img_path'      => 'captcha_images/',
				'img_url'       => base_url().'captcha_images/',
				'img_width'     => '250',
				'img_height'    => 100,
				'word_length'   => 4,
				'font_size'     => 40,
				'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
			);
			
			$captcha = create_captcha($config);
			
			// Unset previous captcha and store new captcha word
			$this->session->unset_userdata('captchaCode');
			$this->session->set_userdata('captchaCode',$captcha['word']);
			
			// Send captcha image to view
			$data['captchaImg'] = $captcha['image'];
			$data['capans'] = $this->session->userdata('captchaCode');
		
			$this->load->view('templete/header');
			$this->load->view('templete/site_nav');
			$this->load->view('site_content/reg_form', $data);
			$this->load->view('templete/footer');
		}
		else
		{
			$this->customer->insert_entry();
			
			if($flag !== 0)
			{
				redirect(base_url().'user_access/signin_page', 'refresh');
			}
			redirect('admin_page/customer_crud', 'refresh');
		}
	}
	
	public function fetch_customer_data() 
	{
		$this->load->model('customer');
		$result = array('data' => array());

		$data = $this->customer->get_customers();
		foreach ($data as $oneRec) {
			// button
			$buttons = '
			  <div class="btn-group">
				<button type="button" class="btn btn-primary" onclick="editCustomer('.$oneRec['CustomerId'].')" data-toggle="modal" data-target="#editCustomer">Edit</button>
				<button type="button" class="btn btn-danger" onclick="deleteCustomer('.$oneRec['CustomerId'].')" data-toggle="modal" data-target="#deleteCustomer">Delete</button>
			  </div>
			  
			  <div class="btn-group">
				<button type="button" class="btn btn-success" onclick="displayDetails('.$oneRec['CustomerId'].')" data-toggle="modal" data-target="#displayDetails">Details</button>
				<button type="button" class="btn btn-warning" onclick="resetCustomer('.$oneRec['CustomerId'].')" data-toggle="modal" data-target="#resetCustomer">Reset</button>
			  </div>
			';
			
			$name = $oneRec['FirstName'] . ' ' . $oneRec['LastName'];
			$address = $oneRec['Address1'] . ', ' . $oneRec['Address2'] . ' <br/>' . $oneRec['City'] . ', ' . $oneRec['Province'] . '<br/> ' . $oneRec['Postcode'] . ', ' . $oneRec['Country']; 
			
			
			$result['data'][] = array(
				$name,
				$oneRec['Email'],
				$oneRec['Telephone'],
				$address,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}
	
	public function get_selected_customer($id) 
	{
		$this->load->model('customer');
		if($id) {
			$data = $this->customer->get_customers($id);
			echo json_encode($data);
		}
	}
	
	public function edit_customer($flag = 0) 
	{
		$validator = array('success' => false, 'messages' => array());
		
		$this->load->library('form_validation');
		$this->load->model('customer');
		//$data['title'] = 'Create a news item';

		$this->form_validation->set_rules('fname', 'First Name', 'required');
		$this->form_validation->set_rules('lname', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('telephone', 'telephone', 'required');
		$this->form_validation->set_rules('addr1', 'Address 1', 'required');
		$this->form_validation->set_rules('addr2', 'Address 2', 'required');
		$this->form_validation->set_rules('city', 'city', 'required');
		$this->form_validation->set_rules('province', 'province', 'required');
		$this->form_validation->set_rules('pcode', 'post code', 'required');
		$this->form_validation->set_rules('country', 'country', 'required');
		
		if($flag != 0)
		{
			$this->form_validation->set_rules('userid', 'user id', 'required');
			$this->form_validation->set_rules('pwd', 'password', 'required');
			$this->form_validation->set_rules('pwd2', 'password confirmation', 'required|matches[pwd]');            			
		}
		
		
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {
			$editCustomer = $this->customer->edit_customer();			
			
			if($editCustomer === true && $flag !== 0)
			{
				$this->session->set_userdata('message', 'User updated successfully!');
				redirect(base_url()."user_access/access_account");
			}
			elseif($editCustomer === true) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully updated";
			} else {
				$validator['success'] = false;
				$validator['messages'] = "Error while updating the infromation";
			}			
		} 
		else {
			if($flag !== 0)
			{
				$this->load->view('templete/header');
				$this->load->view('templete/site_nav');
				$this->load->view('customer_content/update_form2');
				$this->load->view('templete/footer');
			}
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);	
			}
			
		}
		
		if($flag === 0)
		{
			echo json_encode($validator);
		}
		//redirect('admin_page/category_crud', 'refresh');
	}
	
	public function delete_customer($id = null)
	{
		$this->load->model('customer');
		if($id) {
			$validator = array('success' => false, 'messages' => array());

			$deleteCustomer = $this->customer->delete_customer($id);
			if($deleteCustomer === true) {
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
