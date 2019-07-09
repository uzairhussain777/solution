<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Permissions_content extends MY_Controller {
	
	public function  __construct(){
		parent::__construct();
		
    }
	
	public function super_user_view_permissions_content(){
		$access=$this->check_super_admin();
		$this->panels_check_permission($access);
	
		$this -> load -> helper('permissions_content/permissions_content');
		$this -> load -> model('permissions_content/permissions_content_model');
		$this->load->library("pagination");
		$offset = ($this->uri->segment(3) != '' ? $this -> uri -> segment(3): 1);
		$per_page = 5;
		$totalPermissions=$this->permissions_content_model->getallgroupscountforsearch();
		
		if($this->uri->slash_segment(2)=="search/"){
			$url= $this -> config -> base_url() ."permissions/search"; 
    	}else{
    		$url= $this -> config -> base_url() ."permissions/view"; 
    	}    	
		$pagination_detail = $this->pagination->pagination($totalPermissions, $per_page, $offset, $url);
		$data['paginglinks'] = $pagination_detail['paginationLinks'];
		$data['pagermessage'] = $pagination_detail ['paginationMessage'];
		
		$result=$this->permissions_content_model->getallgroupsforsearch($offset,$per_page);
		$data['permissions']=$result;
		$this->load->view('super_user_view_permission_content',$data);
	}
	
	public function super_user_add_permissions_content(){
		$access=$this->check_super_admin();
		$this->panels_check_permission($access);
		$this -> load -> model('permissions_content/permissions_content_model');
		$data['panels'] = $this->permissions_content_model->get_all_panels();
		$this->load->view('super_user_create_permission_content',$data);	
	}
	
	public function super_user_create_permissions(){
		$access=$this->check_super_admin();
		$this->panels_check_permission($access);

		$CI =& get_instance();
		$this -> load -> helper('permissions_content/permissions_content');
		$this -> load -> model('permissions_content/permissions_content_model');
		
		$validation=permissions_validation();
		if($validation){
			$result=$this->permissions_content_model->super_admin_add_permissions();
				header("Location:" . $this -> config -> base_url() . "permissions/view");
		}else{
			header("Location:" . $_SERVER['HTTP_REFERER']);
		}

	}
	
	
	public function super_user_edit_permissions_content(){
		$access=$this->check_super_admin();
		$this->panels_check_permission($access);
		
		$this -> load -> model('permissions_content/permissions_content_model');
		$groupid=$this->input->get("id");
		$data['group']=$this->permissions_content_model->getgroupbyid($groupid);
		$data['group_permission']=$this->permissions_content_model->get_group_permission_detail($groupid);
		$data['panels'] = $this->permissions_content_model->get_all_panels();
		if(count($data['group'])){
			$this->load->view('super_user_edit_permission_content',$data);
		}
		else{
			$CI->session->set_flashdata('error_message','No Record FOund');
			header("Location:" . $_SERVER['HTTP_REFERER']);
		}
		
	}
	
	public function super_user_update_permissions(){
		$access=$this->check_super_admin();
		$this->panels_check_permission($access);
		
		$this -> load -> helper('permissions_content/permissions_content');
		$this -> load -> model('permissions_content/permissions_content_model');
		
		$validation=editGroupValidation();
		if($validation){
			$result=$this->permissions_content_model->super_user_update_group();
			$this->session->set_flashdata('success_message','Group Updated Successfully');
			header("Location:" . $this -> config -> base_url() . "permissions/view");
		}
		else{
			$this->session->set_flashdata('error_message','Form Validation Error');
			header("Location:" . $_SERVER['HTTP_REFERER']);
		}
	
	}
	public function super_admin_delete_permission_group_content(){
		$access=$this->check_super_admin();
		$this->panels_check_permission($access);
		$CI =& get_instance();
		$this -> load -> helper('permissions_content/permissions_content');
		$this -> load -> model('permissions_content/permissions_content_model');
	
		$result=$this->permissions_content_model->super_admin_delete_group();
		if($result != 0){
			$CI->session->set_flashdata('success_message','Record Successfully Deleted');
			header("Location:" . $this -> config -> base_url() . "permissions/view");
		}
		else{
			$CI->session->set_flashdata('error_message','Record not Deleted');
			header("Location:" . $_SERVER['HTTP_REFERER']);
		}

	
	}
	
	public function super_user_manage_users_content(){

		$access=$this->check_super_admin();
		$this->panels_check_permission($access);
		
		$CI =& get_instance();
		$this -> load -> helper('permissions_content/permissions_content');
		$this -> load -> model('permissions_content/permissions_content_model');
		
		$data['users']=$this->permissions_content_model->get_all_admins();
		$groupid=$this->input->get("id");
		$data['group']=$this->permissions_content_model->getgroupbyid($groupid);
		$this->load->view('super_user_view_users_permission_content',$data);
			
	}
	
	
	public function super_user_manage_users_update_content(){
		$access=$this->check_super_admin();
		$this->panels_check_permission($access);
		
		$this -> load -> helper('permissions_content/permissions_content');
		$this -> load -> model('permissions_content/permissions_content_model');
		
		$validation=manageGroupValidation();
		if($validation){
			$result=$this->permissions_content_model->super_user_manage_users_update();
			if($result){
				$this->session->set_flashdata('success_message','Group Users Updated Successfully');
				header("Location:" . $this -> config -> base_url() . "permissions/view");
			}else{
				
				$this->session->set_flashdata('error_message','Group Validation Error');
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}
		}
		else{
			$this->session->set_flashdata('error_message','Form Validation Error');
			header("Location:" . $_SERVER['HTTP_REFERER']);
		}
	
	}
	

	
}