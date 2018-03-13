<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meal_time_control extends CI_Controller {

	public function index()
	{
		
	}
	public function add_meal_time()
	{
		
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->model('meal_time');
		//$data['title'] = 'Create a news item';

		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('start', 'start', 'required');
		$this->form_validation->set_rules('end', 'end', 'required');

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('templete/header');
			$this->load->view('templete/admin_nav');
			$this->load->view('bootstrap/div_row_open');
			$this->load->view('admin_content/admin_sidebar');
			$this->load->view('admin_content/meal_time_form');
			$this->load->view('bootstrap/div_close');
			$this->load->view('templete/footer');
		}
		else
		{
			$this->meal_time->insert_entry();
			redirect('admin_page/meal_time_crud', 'refresh');
		}
	}
	
	public function fetch_meal_time_data() 
	{
		$this->load->model('meal_time');
		$result = array('data' => array());

		$data = $this->meal_time->get_mealtimes();
		foreach ($data as $oneRec) {
			// button
			$buttons = '
			  <div class="btn-group">
				<button type="button" class="btn btn-primary" onclick="editMealTime('.$oneRec['MealTimeId'].')" data-toggle="modal" data-target="#editMealTime">Edit</button>
				<button type="button" class="btn btn-danger" onclick="deleteMealTime('.$oneRec['MealTimeId'].')" data-toggle="modal" data-target="#deleteMealTime">Delete</button>
			  </div>
			';
			
			$result['data'][] = array(
				$oneRec['Name'],
				$oneRec['StartTime'],
				$oneRec['EndTime'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}
	
	public function get_selected_meal_time($id) 
	{
		$this->load->model('meal_time');
		if($id) {
			$data = $this->meal_time->get_mealtimes($id);
			echo json_encode($data);
		}
	}
	
	public function edit_meal_time() 
	{
		$validator = array('success' => false, 'messages' => array());
		
		$this->load->library('form_validation');
		$this->load->database();
		$this->load->model('meal_time');
		//$data['title'] = 'Create a news item';
		
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('start', 'start', 'required');
		$this->form_validation->set_rules('end', 'end', 'required');
		
		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
		
		if($this->form_validation->run() === true) {				
			$editMealTime = $this->meal_time->edit_mealtime();				

			if($editMealTime === true) {
				$validator['success'] = true;
				$validator['messages'] = "Successfully updated";
			} else {
				$validator['success'] = false;
				$validator['messages'] = "Error while updating the infromation";
			}			
		} 
		else {
			echo "test";
			$validator['success'] = false;
			foreach ($_POST as $key => $value) {
				$validator['messages'][$key] = form_error($key);	
			}			
		}
		
		echo json_encode($validator);
		//redirect('admin_page/category_crud', 'refresh');
	}
	
	public function delete_meal_time($id = null)
	{
		$this->load->model('meal_time');
		if($id) {
			$validator = array('success' => false, 'messages' => array());

			$deleteMealTime = $this->meal_time->delete_mealtime($id);
			if($deleteMealTime === true) {
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
