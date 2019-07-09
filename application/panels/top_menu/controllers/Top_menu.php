<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Top_menu extends MX_Controller {
	public function index() {
        
       exit;
    }
	
	public function super_user(){
		$this->load->view('super_user_top_menu');
	}
	
	public function admin(){
		$this->load->view('admin_user_top_menu');
	}
	
	public function user(){
		$this->load->view('user_user_top_menu');
	}
	
	public function homepage(){
		$this->load->view('home_page_top_menu');
	}
	
	public function homepagebanner(){
		$this->load->view('home_page_top_menu_banner');
	}
}