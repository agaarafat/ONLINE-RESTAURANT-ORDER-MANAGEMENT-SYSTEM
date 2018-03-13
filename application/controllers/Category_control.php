<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_control extends CI_Controller {
	public function index()
	{
		
	}
	public function add_category()
	{
		
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->model('category');
		//$data['title'] = 'Create a news item';

		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('desc', 'desc', 'required');
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
			$this->load->view('admin_content/cat_form');
			$this->load->view('bootstrap/div_close');
			$this->load->view('templete/footer');
			
		}
		else
		{
			$config['upload_path']          = './assets/images/categories/';
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
				$createMember = $this->category->insert_entry($file_name);
				redirect('admin_page/category_crud', 'refresh');	
			}
		}		
	}
	
	
	public function fetch_category_data() 
	{
		$this->load->model('category');
		$result = array('data' => array());

		$data = $this->category->get_categories();
		foreach ($data as $oneRec) {
			// button
			$buttons = '
			  <div class="btn-group">
				<button type="button" class="btn btn-primary" onclick="editCategory('.$oneRec['CategoryId'].')" data-toggle="modal" data-target="#editCategory">Edit</button>
				<button type="button" class="btn btn-danger" onclick="deleteCategory('.$oneRec['CategoryId'].')" data-toggle="modal" data-target="#deleteCategory">Delete</button>
			  </div>
			';
			$imgs = '
				<img src=".'.$oneRec['ImagePath'].'" alt="'.$oneRec['Name'].'" width="100"/>
			';
			
			$result['data'][] = array(
				$oneRec['Name'],
				$oneRec['Description'],
				$imgs,
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}
	
	// get single category from database
	public function get_selected_category($id) 
	{
		$this->load->model('category');
		if($id) {
			$data = $this->category->get_categories($id);
			echo json_encode($data);
		}
	}
	
	public function edit_category() 
	{
		$validator = array('success' => false, 'messages' => array());
		
		$file_name = "empty";

		$this->load->library('form_validation');
		$this->load->database();
		$this->load->model('category');
		//$data['title'] = 'Create a news item';
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('desc', 'desc', 'required');
		
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

		if($this->form_validation->run() === true) {
			if (!empty($_FILES['image']['name']))
			{
				$config['upload_path']          = './assets/images/categories/';
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
				
			$editCategory = $this->category->edit_category($file_name);
			//echo "Data updated successfully";
			
				

			if($editCategory === true) {
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
	
	public function delete_category($id = null)
	{
		$this->load->model('category');
		if($id) {
			$validator = array('success' => false, 'messages' => array());

			$deleteCategory = $this->category->delete_category($id);
			if($deleteCategory === true) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully removed";
			}
			else {
				$validator['success'] = true;
				$validator['messages'] = "Successfully removed";
			}

			echo json_encode($validator);
		}
	}
	
}
