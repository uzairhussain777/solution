<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seo extends MY_Controller {
    public function  __construct(){
   
	parent::__construct();
        $this->no_cache();
        //$this->check_admin();
        $this->add_page_title("Admin | isupportcause");
    }
    public function index(){
    	exit;
   	}
	public function view(){
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("SEO","view");
			$this->panels_check_permission($permission);
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
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		$this->load->view($user_types.'_view_seo', $data);
	
	}
	
	public function edit(){
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("SEO","all");
			$this->panels_check_permission($permission);
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
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		$this->load->view($user_types.'_edit_seo', $data);
	}
	
	public function search(){
		$user_type = $this->session->userdata('user_type');
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("SEO","view");
			$this->panels_check_permission($permission);
		}	
			
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
        $this->load->view($user_types.'_view_seo');   
    
	}
	
	public function add(){
		$user_type = $this->session->userdata('user_type');
		
		if($user_type == 'admin'){
					$permission=$this->check_permission_modules_core("SEO","all");
					$this->panels_check_permission($permission);
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
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		$this->load->view($user_types.'_add_seo', $data);
   	}  
	
}
