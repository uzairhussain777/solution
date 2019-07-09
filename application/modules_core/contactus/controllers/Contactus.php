<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Contactus extends My_Controller {
	
	public function __construct() {
		parent::__construct();

	}
	
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
		$this->load->view('contactus_view',$data);
		//$this->load->view('landing_page',$data);		
	}
	
}