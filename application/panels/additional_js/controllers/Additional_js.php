<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Additional_js extends MX_Controller {

    public function index() {
        exit;
        
    }
	
	public function super_user(){
		 $this->load->view('super_user_additional_js');
	}//end of function super_user to add additional scripts to the admin panels for the super user
	
	public function admin(){
		$this->load->view('admin_user_additional_js');
	}//end of function admin to add additional scripts to the admin panels for the admin
	
	public function homepage(){
		$this->load->view('home_additional_js');
	}//end of function homepage to add additional scripts to the front page 
	
}
?>
