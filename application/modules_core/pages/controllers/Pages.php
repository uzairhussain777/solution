<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends MY_Controller {
	
	public function index(){
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
		$email_validation_fail=$this->session->flashdata('email_validation_fail');
		$email_not_found=$this->session->flashdata('email_not_found');
		$email_found_success=$this->session->flashdata('email_found_success');
		$success_conformation_code=$this->session->flashdata('success_conformation_code');
		$error_conformation_code=$this->session->flashdata('error_conformation_code');
		$invalid_email_pass=$this->session->flashdata('invalid_email_pass');
		$signup=$this->session->flashdata('signup_error');
		$success=$this->session->flashdata('success');
		$error_reset_password=$this->session->flashdata('error_reset_password');
		
    	$data['error_message']= $error_message;
		$data['success_message']= $success_message;
		$data['user_add_data'] = $user_add_data;
		$data['email_validation_fail'] = $email_validation_fail;
		$data['email_not_found'] = $email_not_found;
		$data['email_found_success'] = $email_found_success;
		$data['success_conformation_code'] = $success_conformation_code;
		$data['error_conformation_code'] = $error_conformation_code;
		$data['invalid_email_pass'] = $invalid_email_pass;
		$data['signup_error'] = $signup;
		$data['success'] = $success;
		$data['error_reset_password'] = $error_reset_password;
		$this->load->view('pages_view',$data);
		//$this->load->view('landing_page',$data);		
	}
	public function add(){
		$user_type = $this->session->userdata('user_type');
		
		if($user_type == 'admin'){
					$permission=$this->check_permission_modules_core("Pages","all");
					//$this->panels_check_permission($permission);
		}
				
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
    	$data['error_message']= $error_message;
		$data['success_message']= $success_message;
		$data['user_add_data']=$user_add_data;
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		//$user_types=$this->check_usertype_modules_core($allowed_user_types);
		$this->load->view($user_types.'_add_pages', $data);
	}
	
	public function edit(){
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Pages","all");
			//$this->panels_check_permission($permission);
		}		
			
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
		
    	$data['error_message']= $error_message;
		$data['success_message']= $success_message;
		$data['user_add_data']=$user_add_data;
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		//$user_types=$this->check_usertype_modules_core($allowed_user_types);
		$this->load->view($user_types.'_edit_pages', $data);
	}
	
	public function view(){
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Pages","view");
		//	$this->panels_check_permission($permission);
		}	
			
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
    	$data['error_message']= $error_message;
		$data['success_message']= $success_message;
		$data['user_add_data']=$user_add_data;
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		//$user_types=$this->check_usertype_modules_core($allowed_user_types);
		$this->load->view($user_types.'_view_pages', $data);
	
	}
	
	public function search(){
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Pages","view");
		//	$this->panels_check_permission($permission);
		}	
			
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		//$user_types=$this->check_usertype_modules_core($allowed_user_types);
        $this->load->view($user_types.'_view_pages');   
    
	}
}
?>