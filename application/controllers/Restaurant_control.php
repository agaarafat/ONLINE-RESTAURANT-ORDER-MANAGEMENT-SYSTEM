<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurant_control extends CI_Controller {
	
	public function index()
	{
		
	}
	public function add_restaurant()
	{
		
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->model('restaurant');
		//$data['title'] = 'Create a news item';

		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('telephone', 'telephone', 'required');
		$this->form_validation->set_rules('addr1', 'Address 1', 'required');
		$this->form_validation->set_rules('addr2', 'Address 2', 'required');
		$this->form_validation->set_rules('city', 'city', 'required');
		$this->form_validation->set_rules('province', 'province', 'required');
		$this->form_validation->set_rules('pcode', 'post code', 'required');
		$this->form_validation->set_rules('country', 'country', 'required');
		$this->form_validation->set_rules('desc', 'description', 'required');
		if (empty($_FILES['image']['name']))
		{
			$this->form_validation->set_rules('image', 'image', 'required');
		}

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templete/header');
			$this->load->view('templete/admin_nav');
			$this->load->view('bootstrap/div_row_open');
			$this->load->view('admin_content/admin_sidebar');
			$this->load->view('admin_content/reg_form');
			$this->load->view('bootstrap/div_close');
			$this->load->view('templete/footer');
		}
		else
		{
			$config['upload_path']          = './assets/images/restaurants';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['file_name']        = $this->input->post('name');
			$config['max_width']            = 1024;
			$config['max_height']           = 768;

			$this->load->library('upload', $config);
			$this->upload->initialize($config); //Make this line must be here.
			
			if(!$this->upload->do_upload('image'))
				echo $this->upload->display_errors();
			else {
			$img = $this->upload->data();
            $file_name = $img['file_name'];
			$this->restaurant->insert_entry($file_name);
			redirect('admin_page/reg_crud', 'refresh');
			}
		}
	}
	
	public function fetch_restaurant_data() 
	{
		$this->load->model('restaurant');
		$result = array('data' => array());

		$data = $this->restaurant->get_restaurants();
		foreach ($data as $oneRec) {
			// button
			$buttons = '
			  <div class="btn-group">
				<button type="button" class="btn btn-primary" onclick="editRestaurant('.$oneRec['RestaurantId'].')" data-toggle="modal" data-target="#editRestaurant">Edit</button>
				<button type="button" class="btn btn-danger" onclick="deleteRestaurant('.$oneRec['RestaurantId'].')" data-toggle="modal" data-target="#deleteRestaurant">Delete</button>
			  </div>
			';
			
			$address = $oneRec['Address1'] . ', ' . $oneRec['Address2'] . ' <br/>' . $oneRec['City'] . ', ' . $oneRec['Province'] . '<br/> ' . $oneRec['Postcode'] . ', ' . $oneRec['Country']; 
			
			
			$result['data'][] = array(
				$oneRec['Name'],
				$oneRec['Email'],
				$oneRec['Telephone'],
				$address,
				$oneRec['Description'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}
	
	public function fetch_contacts_data() 
	{
		$this->load->model('restaurant');
		$result = array('data' => array());

		$data = $this->restaurant->get_restaurants();
		foreach ($data as $oneRec) {
			
			$name = '<h3>'.$oneRec['City'].'</h3>';
			
			$contact = $oneRec['Address1'] . ', ' . $oneRec['Address2'] . ' <br/> ' . $oneRec['Postcode'] . '<br/> Telephone: ' . $oneRec['Telephone'] . '<br/> Email: ' . $oneRec['Email']; 
			
			
			$result['data'][] = array(
				$name,
				$contact
			);
		} // /foreach

		echo json_encode($result);
	}
	
	public function get_selected_restaurant($id) 
	{
		$this->load->model('restaurant');
		if($id) {
			$data = $this->restaurant->get_restaurants($id);
			echo json_encode($data);
		}
	}
	
	
	public function edit_restaurant() 
	{
		$validator = array('success' => false, 'messages' => array());
		
		$file_name = "empty";

		$this->load->library('form_validation');
		$this->load->database();
		$this->load->model('restaurant');
		//$data['title'] = 'Create a news item';

		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('email', 'email', 'required');
		$this->form_validation->set_rules('telephone', 'telephone', 'required');
		$this->form_validation->set_rules('addr1', 'Address 1', 'required');
		$this->form_validation->set_rules('addr2', 'Address 2', 'required');
		$this->form_validation->set_rules('city', 'city', 'required');
		$this->form_validation->set_rules('province', 'province', 'required');
		$this->form_validation->set_rules('pcode', 'post code', 'required');
		$this->form_validation->set_rules('country', 'country', 'required');
		$this->form_validation->set_rules('desc', 'description', 'required');
		
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {
			if (!empty($_FILES['image']['name']))
			{
				$config['upload_path']          = './assets/images/menus/';
				$config['allowed_types']        = 'gif|jpg|png';
				$config['file_name']        = $this->input->post('name');
				$config['max_width']            = 1024;
				$config['max_height']           = 768;

				$this->load->library('upload', $config);
				$this->upload->initialize($config); //Make this line must be here.
				if(!$this->upload->do_upload('image'))
					echo $this->upload->display_errors();
				else {
					$img = $this->upload->data();
					$file_name = $img['file_name'];					
				}
			}			
				
			$editRestaurant = $this->restaurant->edit_restaurant($file_name);
			//echo "Data updated successfully";
			
				
			
			if($editRestaurant === true) {
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
	
	public function delete_restaurant($id = null)
	{
		$this->load->model('restaurant');
		if($id) {
			$validator = array('success' => false, 'messages' => array());

			$deleteRestaurant = $this->restaurant->delete_restaurant($id);
			if($deleteRestaurant === true) {
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
