<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller {
    public function  __construct(){
	parent::__construct();
        $this->no_cache();
        $this->add_page_title("Login | ecommerce");
    }
    public function index(){
    	$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
    	$data['error_message']= $error_message;
		$data['success_message']= $success_message;
		$data['user_add_data'] = $user_add_data;
        $this->load->view('login',$data);

   	} //end of the function index to show the login page for the admin  module 
	
	public function forgotpassword(){
		$this->add_page_title("Forgot Password | emr");
        $this->load->view('forgot_password');
    }//end of the function forgotpassword to open the popup the forgot password 
	public function passwordreset(){
		$this->add_page_title("Reset Password | emr");
        $this->load->view('restpassword');
    }//end of the funnction to opeen the popup of the password reset to reset the password
    public function conformationcode(){
		$this->add_page_title("Conformation code | emr");
        $this->load->view('conformation_code');
    }//end  of the function conformationcode to show the popup of th conformation code 
}
