<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_access extends CI_Controller {
	function __construct() 
	{
		parent::__construct();
        
	}
	public function index()
	{
		$this->load->view('templete/header');
		$this->load->view('templete/site_nav');
		$this->load->view('site_content/signin_form');
		$this->load->view('templete/footer');		
	}
	
	public function signin_page()
	{
		$this->load->view('templete/header');
		$this->load->view('templete/site_nav');
		$this->load->view('site_content/signin_form');
		$this->load->view('templete/footer');
	}
	
	public function registration()
	{
		$this->load->helper(array('form', 'captcha')); 
		$this->load->library('session');
		
		// Captcha configuration
        $config = array(
			'word'          => '',
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'img_width'     => '250',
            'img_height'    => 100,
            'word_length'   => 4,
            'font_size'     => 40,
			'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
        );
		
		$captcha = create_captcha($config);
        
        // Unset previous captcha and store new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);
        
        // Send captcha image to view
        $data['captchaImg'] = $captcha['image'];
		$data['capans'] = $this->session->userdata('captchaCode');
		
		
		$this->load->view('templete/header');
		$this->load->view('templete/site_nav');
		$this->load->view('site_content/reg_form', $data);
		$this->load->view('templete/footer');
	}
	
	public function signin_user()
	{
		/*if(!$this->session->has_userdata('user_id'))
		{
			redirect(base_url());
		}*/
		$this->form_validation->set_rules('userid', 'User ID', 'required');
		$this->form_validation->set_rules('pwd', 'Password', 'required');
		
		$this->load->model('customer');
		$data['users'] = $this->customer->get_a_customer();
		
		if ($this->form_validation->run() === FALSE || $data['users'] == null)
		{
			if($data['users'] == null)
				$this->session->set_userdata('error', 'User Id or Password does not match!');
			
			$this->load->view('templete/header');
			$this->load->view('templete/site_nav');
			$this->load->view('site_content/signin_form');
			$this->load->view('templete/footer');
		}
		else
		{
			$user_data = array (
				'user_type' => 'customer',
				'user_id' => $data['users']['CustomerId'],
				'user_name' => $data['users']['FirstName'] . ' ' . $data['users']['LastName'],
				'user_email' => $data['users']['Email'],
				'user_phone' => $data['users']['Telephone']
			);
			
			$this->session->set_userdata($user_data);
			$this->session->set_userdata('message', 'Sign In Done Successfully!');
			
			$this->load->view('templete/header');
			$this->load->view('templete/user_nav');
			$this->load->view('site_content/page_selection');
			$this->load->view('templete/footer');
			
		}
	}
	
	public function signout()
	{
		$user_data = array ('user_id', 'user_name', 'user_email', 'user_phone');
		$this->session->unset_userdata($user_data);
		
		redirect(base_url());
	}
	
	public function access_account()
	{
		if(!$this->session->has_userdata('user_type'))
		{
			redirect(base_url(), 'refresh');
		}
		$user_id = $this->session->userdata('user_id');
		$this->load->model('customer');
		$data['user'] = $this->customer->get_customers($user_id);
			
		$this->load->view('templete/header');
		$this->load->view('templete/site_nav');
		$this->load->view('customer_content/user_dash', $data);
		$this->load->view('templete/footer');
	}
	
	public function update_page()
	{
		$user_id = $this->session->userdata('user_id');
		$this->load->model('customer');
		$data['user'] = $this->customer->get_customers($user_id);
		
		$this->load->view('templete/header');
		$this->load->view('templete/site_nav');
		$this->load->view('customer_content/update_form', $data);
		$this->load->view('templete/footer');
	}
	
	public function captcha_refresh(){
		$this->load->helper(array('form', 'captcha')); 
		$this->load->library('session');
        // Captcha configuration
        $config = array(
            'img_path'      => 'captcha_images/',
            'img_url'       => base_url().'captcha_images/',
            'img_width'     => '150',
            'img_height'    => 50,
            'word_length'   => 4,
            'font_size'     => 16
        );
        $captcha = create_captcha($config);
        
        // Unset previous captcha and store new captcha word
        $this->session->unset_userdata('captchaCode');
        $this->session->set_userdata('captchaCode',$captcha['word']);
        $this->session->sess_destroy();
        // Display captcha image
        echo $captcha['image'];
    }
	
}
