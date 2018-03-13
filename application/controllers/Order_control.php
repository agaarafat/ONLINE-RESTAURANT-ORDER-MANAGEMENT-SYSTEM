<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_control extends CI_Controller {
	public function index()
	{
		
	}
		
	public function order_now()
	{
		if($this->session->has_userdata('user_id')) 
		{
			$user_id = $this->session->userdata('user_id');
			$this->load->model('customer');
			$data['user'] = $this->customer->get_customers($user_id);
			
			$this->load->model('restaurant');
			$data['restaurants'] = $this->restaurant->get_restaurants();
			
			$this->load->view('templete/header');
			$this->load->view('templete/site_nav');
			$this->load->view('order_content/order_info', $data);
			$this->load->view('order_content/order_option', $data);
			$this->load->view('templete/footer');
		}
		else
		{
			echo "not connected";
		}
	}
	
	public function make_order()
	{
		$this->form_validation->set_rules('ordertype', 'Order Type', 'required');
		$this->form_validation->set_rules('location', 'Location', 'required');
		$this->form_validation->set_rules('paymenttype', 'Payment Type', 'required');
		$this->form_validation->set_rules('cnumber', 'Card Number', 'required');
		$this->form_validation->set_rules('code', 'Security Code', 'required');
		$this->form_validation->set_rules('month', 'Month', 'required');
		$this->form_validation->set_rules('year', 'Year', 'required');
		$this->form_validation->set_rules('name', 'Name on Card', 'required');
		
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->model('restaurant');
			$data['restaurants'] = $this->restaurant->get_restaurants();
			
			$this->load->view('templete/header');
			$this->load->view('templete/site_nav');
			$this->load->view('order_content/order_option', $data);
			$this->load->view('templete/footer');
		}
		else
		{
			$this->load->model('order');
			$this->load->model('payment');			
			$this->load->model('order_item');
			$this->load->model('menu');			
			
			$str = $this->menu->check_menu_stock();
			if($str !== "")
			{
				$str = "stock Limited are " . $str . "<br/>Please update quantity";
				$this->session->set_userdata('stock_error', $str);
				redirect('menu_page', 'refresh');
			}
			
			$p_id = $this->payment->insert_entry();
			$o_id = $this->order->insert_entry($p_id);
			$this->menu->update_menu_stock();
			$status = $this->payment->update_oid($p_id, $o_id);
			if($status)
			{
				$this->order_item->insert_entry($o_id);
			}
			$this->session->unset_userdata('stock_error', $str);
			$this->cart->destroy();
			$str = "You have ordered successfully!";
			$this->session->set_userdata('message', $str);
			
			$this->load->view('templete/header');
			$this->load->view('templete/site_nav');
			$this->load->view('site_content/page_selection');
			$this->load->view('templete/footer');
		}
	}
	
	public function fetch_orders_by_cid()
	{
		$user_id = $this->session->userdata('user_id');		
		
		$this->load->model('order');
		$result = array('data' => array());

		$data = $this->order->get_orders_by_cid($user_id);
		$i = 0;
		foreach ($data as $oneRec) {
			$i++;
			$amount = $oneRec['TotalAmount'] + $oneRec['TPS'] + $oneRec['TVQ'];
			$result['data'][] = array(
				$i,
				$oneRec['Status'],
				$oneRec['Type'],
				$oneRec['OrderDate'],
				$amount
			);
		} // /foreach

		echo json_encode($result);
	}
	
	public function fetch_order_data($flag = null) 
	{
		$this->load->model('order');
		$result = array('data' => array());

		$data = $this->order->get_orders();
		
		$status = "";
		foreach ($data as $oneRec) {
			// button
			$buttons = '
			  <div class="btn-group">
				<a href="'.base_url().'employee_page/display_details/'.$oneRec['OrderId'].'" class="btn btn-primary">Details</a>
			</div>
			';
			if($oneRec['Status'] === 'Pending')
				$status = '<p class="bg-danger">Pending</p>';
			elseif($oneRec['Status'] === 'Preparing')
				$status = '<p class="bg-info">Preparing</p>';
			elseif($oneRec['Status'] === 'Completed')
				$status = '<p class="bg-success">Completed</p>';
			elseif($oneRec['Status'] === 'Delivering')
				$status = '<p class="bg-info">Delivering</p>';
			elseif($oneRec['Status'] === 'Received')
				$status = '<p class="bg-success">Received</p>';
			elseif($oneRec['Status'] === 'Delivered')
				$status = '<p class="bg-primary">Delivered</p>';
			else 
				$status = '<p style="color:red;"><b>Canceled</b></p>';
			
			$name = $oneRec['FirstName']. " " . $oneRec['LastName'];
			
			if($flag !== null)
			{
				$id = $oneRec['OrderId'];
				$val = 0;
				if($oneRec['Status'] === 'Pending')
					$val = 1;
				$buttons = '
				  <div class="btn-group">
					<a href="'.base_url().'admin_page/display_details/'.$oneRec['OrderId'].'" class="btn btn-primary">Details</a>
					<button type="button" class="btn btn-danger" onclick="cancelOrder('.$id.', '. $val .')" data-toggle="modal" data-target="#cancelOrder">Cancel</button>
				  </div>
				  ';
				$time = $oneRec['OrderDate'] . "<br/>(". $oneRec['ReadyTime'] .")";
			  
				$result['data'][] = array(
					$oneRec['OrderId'],
					$oneRec['Location'],
					$name,
					$status,
					$oneRec['Type'],
					$time,
					$oneRec['TotalAmount'],
					$buttons
				);
			}
			else 
			{
				$result['data'][] = array(
					$oneRec['OrderId'],
					$oneRec['Location'],
					$name,
					$status,
					$oneRec['Type'],
					$oneRec['ReadyTime'],
					$oneRec['OrderDate'],
					$buttons
				);
			}
		} // /foreach

		echo json_encode($result);
	}
	
	public function update_order_status($oid = null, $status = 'Pending', $current = null)
	{
		$validator = array('success' => false, 'messages' => array());
		$this->load->model('order');
		if($status === 'Received')
		{
			$this->load->model('pickup');		
			$this->pickup->insert_entry();
		}
		elseif ($status === 'Canceled' && $current === '1')
		{		
			$this->order->cancel_order($oid);		
			$this->order->update_status($oid, $status);
			
			$this->load->model('payment');
			$this->payment->return_money($oid);
		
			//redirect(base_url().'admin_page/order_list', 'refresh');
			
			$validator['success'] = true;
			$validator['messages'] = "Successfully canceled";
		}
		elseif ($status === 'Canceled' && $current === '0')
		{	
			$validator['success'] = false;
			$validator['messages'] = "Order does not canceled";
			//$this->session->set_userdata('error', 'You Can not cancel this order!');
			//redirect(base_url().'admin_page/order_list', 'refresh');
		}
		else 
		{
			if($status === 'Delivered')
			{
				$this->load->model('delivery');
				$this->delivery->update_status($oid, $status);
			}
			$this->order->update_status($oid, $status);
		
			redirect('employee_page/display_details/'. $oid, 'refresh');
		}
		echo json_encode($validator);
	}
}
