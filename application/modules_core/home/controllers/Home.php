<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	
	public function index(){
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		//$user_add_data=$this->session->flashdata('user_add_data');
		$email_validation_fail=$this->session->flashdata('email_validation_fail');
		$email_not_found=$this->session->flashdata('email_not_found');
		$email_found_success=$this->session->flashdata('email_found_success');
		$success_conformation_code=$this->session->flashdata('success_conformation_code');
		$error_conformation_code=$this->session->flashdata('error_conformation_code');
		$invalid_email_pass=$this->session->flashdata('invalid_email_pass');
		$signup=$this->session->flashdata('signup_error');
		$success=$this->session->flashdata('success');
		$error_reset_password=$this->session->flashdata('error_reset_password');
		$Temp_user=$this->session->flashdata('Temp_user');
        $user_add_data=$this->session->flashdata('user_add_data');
		
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
		$data['Temp_user'] = $Temp_user;
        $data['user_add_data'] = $user_add_data;

		$this->load->view('home_page',$data);
	}/*
	 *end og the function index that is used on the front end of the site and the data is set to 
	 * show messages and the open the popups on error messages
	 * */
}