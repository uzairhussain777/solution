<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {
	public function profile(){
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
		
		$this->load->view('profile',$data);
	}
	
	public function search(){
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
        $this->load->view($user_types.'_view_user');   
    }
	
	public function add(){
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
		$data['success_message']=$success_message;
		$data['error_message']=$error_message;
		$data['user_add_data']=$user_add_data;
		$allowed_user_types=array(
			1=>'super_user',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		$this->load->view($user_types.'_add_user', $data);
	}//end of the function to add the record of users to create new admin panels users
	
	public function view(){
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
		$data['user_add_data']=$user_add_data;
		$data['success_message']=$success_message;
		$data['error_message']=$error_message;
		$allowed_user_types=array(
			1=>'super_user',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		$this->load->view($user_types.'_view_user', $data);
		}//end of the function view to view all users of the system 
	
	public function edit(){
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
		$data['success_message']=$success_message;
		$data['error_message']=$error_message;
		$data['user_add_data']=$user_add_data;
		
		$allowed_user_types=array(
			1=>'super_user',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		$this->load->view($user_types.'_edit_user');
	}//end of the function edit to edit the record of the users 
	
	public function activities($search= null){
		$allowed_user_types=array(
			1=>'super_user',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		$this->load->view($user_types.'_view_login_activities');
	}//end of the function loginactivities to view the success and faliures status of the users trying to log in system
}