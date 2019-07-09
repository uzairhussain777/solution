<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permissions extends MY_Controller {
	public function index(){
		exit;
	}
	
	public function add(){
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
    	$data['error_message']= $error_message;
		$data['success_message']= $success_message;
		$data['user_add_data']=$user_add_data;
		$allowed_user_types=array(
			1=>'super_user'
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		$this->load->view($user_types.'_add_permission', $data);
	}
	
	public function search(){
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
        $this->load->view($user_types.'_view_permission');   
    }
	
	public function users(){
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
    	$data['error_message']= $error_message;
		$data['success_message']= $success_message;
		$data['user_add_data']=$user_add_data;
		$allowed_user_types=array(
			1=>'super_user'
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		$this->load->view($user_types.'_manage_users_permission', $data);
	}
	public function edit(){
		$allowed_user_types=array(
			1=>'super_user'
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
		
    	$data['error_message']= $error_message;
		$data['success_message']= $success_message;
		$data['user_add_data']=$user_add_data;
		$this->load->view($user_types.'_edit_permission', $data);
	}
	
	public function view(){
		
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
    	$data['error_message']= $error_message;
		$data['success_message']= $success_message;
		$data['user_add_data']=$user_add_data;
		$allowed_user_types=array(
			1=>'super_user'
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		$this->load->view($user_types.'_view_permission', $data);
	}
}