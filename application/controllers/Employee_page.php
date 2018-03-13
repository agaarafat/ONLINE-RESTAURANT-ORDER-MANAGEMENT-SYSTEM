<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_page extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        if(!$this->session->has_userdata('user_role') && ($this->session->userdata('user_role') !== 'Salesman' || $this->session->userdata('user_role') !== 'Deliveryman'))
		{
			redirect(base_url().'employee_access', 'refresh');
		}
    }
	public function index()
	{
		$this->load->view('templete/header');
		$this->load->view('templete/site_nav');
		$this->load->view('bootstrap/div_row_open');
		$this->load->view('employee_content/emp_sidebar');
		$this->load->view('employee_content/emp_body');
		$this->load->view('bootstrap/div_close');
		$this->load->view('templete/footer');
	}
	public function control($param = 'emp_body')
	{
		$this->load->view('templete/header');
		$this->load->view('templete/site_nav');
		$this->load->view('employee_content/emp_sidebar');
		$this->load->view('employee_content/'. $param);
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
		
		$this->load->view('templete/header');
		$this->load->view('templete/site_nav');
		$this->load->view('employee_content/emp_sidebar');
		$this->load->view('employee_content/order_details', $data);
		$this->load->view('templete/footer');
	}
}
