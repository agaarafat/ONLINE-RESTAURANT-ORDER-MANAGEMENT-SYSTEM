<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Food_cart extends CI_Controller {
	public function  __construct()
	{
		parent::__construct();
		$this->load->model('menu');
	}
	
	public function index()
	{						
	}
	
	public function add_cart_item()
	{
		if($this->menu->validate_add_cart_item() === true)
		{
			if($this->input->post('ajax')!= '1')
			{
				redirect('menu_page');
			}
			else
			{
				echo 'true';
			}
		}
	}
	
	public function show_cart()
	{
		$this->load->model('menu');
		$data['menus'] = $this->menu->get_menus();
		$this->load->view('menu_content/menu_order', $data);
	}
	
	public function update_cart(){
		$this->menu->validate_update_cart();
		redirect('menu_page');
	}
	
	public function empty_cart(){
		$this->cart->destroy(); // Destroy all cart data
		redirect('menu_page');
	}
}
