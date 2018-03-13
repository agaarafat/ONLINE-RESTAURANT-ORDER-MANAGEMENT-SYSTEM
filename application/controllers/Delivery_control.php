<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delivery_control extends CI_Controller {
	public function index()
	{
	}
	
	
	public function make_delivery($oid = null)
	{
		$this->form_validation->set_rules('person', 'Assign Person', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->model('order');
			$data['orders'] = $this->order->get_orders($oid);
			
			$this->load->model('order_item');
			$data['order_items'] = $this->order_item->get_items_by_oid($oid);
			
			$this->load->model('restaurant');
			$data['restaurants'] = $this->restaurant->get_restaurants();
			
			$this->load->model('employee');
			$data['employees'] = $this->employee->get_employees();	
			
			$this->load->view('templete/header');
			$this->load->view('templete/site_nav');
			$this->load->view('employee_content/emp_sidebar');
			$this->load->view('employee_content/order_details', $data);
			$this->load->view('templete/footer');
		}
		else
		{
			$this->load->model('delivery');
			$this->delivery->insert_entry();
			
			$this->load->model('order');		
			$this->order->update_status($oid, 'Delivering');
			redirect('employee_page/display_details/'. $oid, 'refresh');
		}
	}
	
	public function fetch_delivery_data() 
	{
		$this->load->model('delivery');
		$result = array('data' => array());

		$data = $this->delivery->get_deliveries();
		
		$status = "";
		foreach ($data as $oneRec) {
			$name = $oneRec['FirstName'] . ' ' . $oneRec['LastName'];
			$address = $oneRec['Address1'] . ', ' . $oneRec['Address2'] . ' <br/>' . $oneRec['City'] . ', ' . $oneRec['Province'] . '<br/> ' . $oneRec['Postcode'] . ', ' . $oneRec['Country']; 
			
			$result['data'][] = array(
				$name,
				$address,
				$oneRec['Telephone'],
				$oneRec['Email'],
				$oneRec['OrderId'],
				$oneRec['Name'],
				$oneRec['Status']
			);
		} // /foreach

		echo json_encode($result);
	}
}
