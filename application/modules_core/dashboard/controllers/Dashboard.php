<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Dashboard extends My_Controller {
	
	public function __construct() {
		parent::__construct();

	}
	
	public function view(){
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
		$data['success_message']=$success_message;
		$data['error_message']=$error_message;
		$data['user_add_data']=$user_add_data;
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin'			
		);
		//echo "dashboard";exit;
		//$user_types=$this->check_usertype_modules_core($allowed_user_types);
		//echo "<pre>";print_r($check_usertype_modules_core);exit;
		$this->load->view('admin_dashboard',$data);
	}//end of module core function view to view the record on the dashbord 
	
}