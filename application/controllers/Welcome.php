<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		$this->load->model('restaurant');
		$data['restaurants'] = $this->restaurant->get_restaurants();
		
		$this->load->model('menu');
		$data['menus'] = $this->menu->get_menus();
		$this->load->view('templete/header');
		$this->load->view('templete/home_nav');
		$this->load->view('site_content/site_banner', $data);
		$this->load->view('site_content/site_intro');
		$this->load->view('site_content/site_content', $data);
		$this->load->view('site_content/site_contact');
		$this->load->view('templete/footer');
	}
	public function demo()
	{		
		$this->load->view('templete/header');
		$this->load->view('templete/page_selection');;
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
        
        // Display captcha image
        echo $captcha['image'];
    }
}
