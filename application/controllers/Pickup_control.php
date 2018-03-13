<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pickup_control extends CI_Controller {
	public function index()
	{
		
	}
		
	public function fetch_pickup_data() 
	{
		$this->load->model('pickup');
		$result = array('data' => array());

		$data = $this->pickup->get_pickups();
		
		$status = "";
		foreach ($data as $oneRec) {
			$name = $oneRec['FirstName'] . ' ' . $oneRec['LastName'];
			
			$result['data'][] = array(
				$name,
				$oneRec['Telephone'],
				$oneRec['Email'],
				$oneRec['OrderId'],
				$oneRec['Status']
			);
		} // /foreach

		echo json_encode($result);
	}
}
