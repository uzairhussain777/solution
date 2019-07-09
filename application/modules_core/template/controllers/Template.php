<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template extends MY_Controller {
	public function  __construct(){
		parent::__construct();
        $this->no_cache();
        $this->add_page_title("Template | Twelve 4 Twelve");
    }
	
	public function add(){
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Templates","all");
			$this->panels_check_permission($permission);
		}	
		
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
    	$data['error_message']= $error_message;
		$data['success_message']= $success_message;
		$data['user_add_data']=$user_add_data;
		
		$this->load->view($user_types.'_add_template',$data);
	}//end of the function add to add record of templates 
	
	public function search(){
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Templates","view");
			$this->panels_check_permission($permission);
		}	
		
		
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
        $this->load->view($user_types.'_view_template');   
    }
	
	public function view(){
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Templates","view");
			$this->panels_check_permission($permission);
		}	

		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
    	$data['error_message']= $error_message;
		$data['success_message']= $success_message;
		$data['user_add_data']=$user_add_data;
		
		$this->load->view($user_types.'_view_template',$data);
	}
	public function edit(){
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Templates","all");
			$this->panels_check_permission($permission);
		}	
		
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		
		$success_message=$this->session->flashdata('success_message');
		$error_message=$this->session->flashdata('error_message');
		$user_add_data=$this->session->flashdata('user_add_data');
		
    	$data['error_message']= $error_message;
		$data['success_message']= $success_message;
		$data['user_add_data']=$user_add_data;
		
		$this->load->view($user_types.'_edit_templates', $data);
	}//end of the function edit to edit the record of the templates
}