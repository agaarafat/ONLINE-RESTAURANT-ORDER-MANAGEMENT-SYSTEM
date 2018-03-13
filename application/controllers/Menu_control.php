<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_control extends CI_Controller {
	
	public function index()
	{
		
	}
	public function add_menu()
	{
		
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->model('menu');
		//$data['title'] = 'Create a news item';

		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('desc', 'desc', 'required');
		$this->form_validation->set_rules('price', 'price', 'required');
		$this->form_validation->set_rules('category', 'category', 'required');
		if (empty($_FILES['image']['name']))
		{
			$this->form_validation->set_rules('image', 'image', 'required');
		}
		$this->form_validation->set_rules('mtime', 'mtime', 'required');
		$this->form_validation->set_rules('sqnt', 'sqnt', 'required');
		$this->form_validation->set_rules('mqnt', 'mqnt', 'required');
		$this->form_validation->set_rules('option', 'option', 'required');	
		

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templete/header');
			$this->load->view('templete/admin_nav');
			$this->load->view('bootstrap/div_row_open');
			$this->load->view('admin_content/admin_sidebar');
			$this->load->view('admin_content/menu_form');
			$this->load->view('bootstrap/div_close');
			$this->load->view('templete/footer');
		}
		else
		{				
			$config['upload_path']          = './assets/images/menus';
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
			$this->menu->insert_entry($file_name);
			redirect('admin_page/menu_crud', 'refresh');
			}
		}
	}
	
	public function fetch_menu_data() 
	{
		$this->load->model('menu');
		$result = array('data' => array());

		$data = $this->menu->get_menus();
		foreach ($data as $oneRec) {
			// button
			$buttons = '
			  <div class="btn-group">
				<button type="button" class="btn btn-primary" onclick="editMenu('.$oneRec['MenuId'].')" data-toggle="modal" data-target="#editMenu">Edit</button>
				<button type="button" class="btn btn-danger" onclick="deleteMenu('.$oneRec['MenuId'].')" data-toggle="modal" data-target="#deleteMenu">Delete</button>
			  </div>
			';
			
			$result['data'][] = array(
				$oneRec['Name'],
				$oneRec['Price'],
				$oneRec['Description'],
				$oneRec['CategoryName'],
				$oneRec['StockQuantity'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}
	
	public function get_selected_menu($id) 
	{
		$this->load->model('menu');
		if($id) {
			$data = $this->menu->get_menus($id);
			echo json_encode($data);
		}
	}
	
	public function edit_menu() 
	{
		$validator = array('success' => false, 'messages' => array());
		
		$file_name = "empty";

		$this->load->library('form_validation');
		$this->load->database();
		$this->load->model('menu');
		//$data['title'] = 'Create a news item';

		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('desc', 'desc', 'required');
		$this->form_validation->set_rules('price', 'price', 'required');
		$this->form_validation->set_rules('category', 'category', 'required');
		$this->form_validation->set_rules('mtime', 'mtime', 'required');
		$this->form_validation->set_rules('sqnt', 'sqnt', 'required');
		$this->form_validation->set_rules('mqnt', 'mqnt', 'required');
		$this->form_validation->set_rules('option', 'option', 'required');
		
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
				
			$editMenu = $this->menu->edit_menu($file_name);
			//echo "Data updated successfully";
			
				
			
			if($editMenu === true) {
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
	
	public function delete_menu($id = null)
	{
		$this->load->model('menu');
		if($id) {
			$validator = array('success' => false, 'messages' => array());

			$deleteMenu = $this->menu->delete_menu($id);
			if($deleteMenu === true) {
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
