<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_page extends CI_Controller {
	
	function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('user_role') && $this->session->userdata('user_role') !== 'Admin')
		{
			redirect(base_url().'employee_access', 'refresh');
		}
    }

	public function index()
	{		
		$this->load->view('templete/header');
		$this->load->view('templete/admin_nav');
		$this->load->view('bootstrap/div_row_open');
		$this->load->view('admin_content/admin_sidebar');
		$this->load->view('bootstrap/div_close');
		$this->load->view('templete/footer');
	}
	public function control($param = 'reg_form')
	{
		$this->load->helper('form');
		$this->load->database();	
		
		$this->load->view('templete/header');
		$this->load->view('templete/admin_nav');
		$this->load->view('bootstrap/div_row_open');
		$this->load->view('admin_content/admin_sidebar');
		if($param === 'menu_form' || $param === 'menu_crud')
		{
			$this->load->model('category');
			$data['categories'] = $this->category->get_categories();
			
			$this->load->model('meal_time');
			$data['meal_times'] = $this->meal_time->get_mealtimes();
			$this->load->view('admin_content/'. $param, $data);
		}
		else
			$this->load->view('admin_content/'. $param);
		$this->load->view('bootstrap/div_close');
		$this->load->view('templete/footer');
	}
	
	public function display_details($oid = null)
	{
		$this->load->model('order');
		$data['orders'] = $this->order->get_orders($oid);
		
		$this->load->model('order_item');
		$data['order_items'] = $this->order_item->get_items_by_oid($oid);
		
		$this->load->model('restaurant');
		$data['restaurants'] = $this->restaurant->get_restaurants();
		
		$this->load->model('employee');
		$data['employees'] = $this->employee->get_employees();		
		
		if($data['orders']['Status'] === 'Pending')
		{
			$this->order->update_status($oid, 'Preparing');
		}
		echo "<br/><br/><br/>";
		echo "<div class='container'><a class='btn btn-primary btn-lg pull pull-right' href='". base_url()."admin_page/order_list'> Back to Main Menu</a></div>";
		$this->load->view('templete/header');
		$this->load->view('templete/admin_nav');
		$this->load->view('employee_content/order_details', $data);
		$this->load->view('templete/footer');
	}
}
