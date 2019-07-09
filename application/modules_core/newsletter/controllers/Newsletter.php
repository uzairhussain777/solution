<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter extends MY_Controller {
    public function  __construct(){
		parent::__construct();
	    $this->no_cache();
	    $this->add_page_title("");
    }
  
  	public function add(){
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Newsletters","all");
		//	$this->panels_check_permission($permission);
		}	
		
  		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
    	$data['error_message']= $error_message;
		$data['success_message']= $success_message;
		$data['user_add_data']=$user_add_data;
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		$this->load->view($user_types.'_add_newsletter',$data);	  
	}//end of the function add to add the newseltter record 
	
	public function search(){
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Newsletters","view");
		//	$this->panels_check_permission($permission);
		}	
		
		
		
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
        $this->load->view($user_types.'_view_newsletter');   
    }
	
	public function view(){
		
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			
			$permission=$this->check_permission_modules_core("Newsletters","view");
		//	$this->panels_check_permission($permission);
			
		}	
  		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
    	$data['error_message']= $error_message;
		$data['success_message']= $success_message;
		$data['user_add_data']=$user_add_data;
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		$this->load->view($user_types.'_view_newsletter',$data);
	}//end of the funtion view to view all record of the newsletter 
	
	public function edit(){
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Newsletters","all");
			//$this->panels_check_permission($permission);
		}	
  		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
    	$data['error_message']= $error_message;
		$data['success_message']= $success_message;
		$data['user_add_data']=$user_add_data;
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
			$this->load->view($user_types.'_edit_newsletter',$data);
	}//end of the function edit to edit the record of the newsletters
	
}