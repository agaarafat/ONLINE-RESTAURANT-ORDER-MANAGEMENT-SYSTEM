<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_page extends CI_Controller {
	public function index()
	{
		$this->load->database();
		
		$this->load->model('category');
		$data['categories'] = $this->category->get_categories();
		
		$this->load->model('meal_time');
		$data['meal_times'] = $this->meal_time->get_mealtimes();
		
		$this->load->model('menu');
		$data['menus'] = $this->menu->get_menus();
		
		$this->load->view('templete/header', $data);
		$this->load->view('templete/site_nav');
		$this->load->view('menu_content/menu_banner');
		$this->load->view('bootstrap/div_row_open');
		$this->load->view('menu_content/menu_cat');
		$this->load->view('menu_content/menu_list');
		$this->load->view('menu_content/menu_order');	
		$this->load->view('bootstrap/div_close');
		$this->load->view('templete/footer');
	}
	
	public function get_menus_by_cat($id = null)
	{
		if($id === null)
		{
			echo "<h3>Please select a category first!</h3>";
		}
		else
		{
			$this->load->model('menu');
			$data['menus'] = $this->menu->get_menus_by_category($id);
			if($data['menus'] != null) 
			{
				$this->load->view('menu_content/menu_filter_list', $data);
			}
			else 
			{
				echo "<h3>There are no menuse in this list!</h3>";
			}
		}
	}
}
