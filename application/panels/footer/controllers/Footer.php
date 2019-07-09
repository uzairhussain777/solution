<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Footer extends MY_Controller {

     public function index() {
        
       exit;
    }
	
	public function super_user(){
		$this->load->view('super_footer');
	}
	
	public function admin(){
		$this->load->view('admin_footer');
	}
	
	public function user(){
		$this->load->view('user_footer');
	}
	
	public function homepage(){
		$this->load->model('footer/Footer_model');
		$result=$this->Footer_model->get_first_five_categories();
		
		$data['result']=$result;
		$this->load->view('home_footer',$data);	
	}
}
