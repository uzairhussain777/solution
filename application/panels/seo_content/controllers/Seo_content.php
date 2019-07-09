<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Seo_content extends MY_Controller {
	
	public function  __construct(){
		parent::__construct();
		
    }
	/***super_user_add_seo_view function views the page for adding a seo******/
	public function super_user_add_seo_view(){	
		$user_type = $this->session->userdata('user_type');
		
		if($user_type == 'admin'){
					$permission=$this->check_permission_modules_core("SEO","all");
					$this->panels_check_permission($permission);
		}	
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		$this->load->view($user_types.'_create_seo_content');
	}	
	/******super_admin_delete_seo function is used to delete a seo from database***********/
	public function super_admin_delete_seo(){
		$user_type = $this->session->userdata('user_type');
		
		if($user_type == 'admin'){
					$permission=$this->check_permission_modules_core("SEO","all");
					$this->panels_check_permission($permission);
		}	
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
	
		$CI =& get_instance();
		$this -> load -> helper('seo_content/seo_content');
		$this -> load -> model('seo_content/seo_content_model');
	
		$result=$this->seo_content_model->super_admin_delete_seo();
		if($result != 0){
			$CI->session->set_flashdata('success_message','SEO  Successfully Deleted');
			header("Location:" . $this -> config -> base_url() . "seo/view");
		}
		else{
			$CI->session->set_flashdata('error_message','SEO is not Deleted');
			header("Location:" . $_SERVER['HTTP_REFERER']);
		}
	}
	
	/*****addnewseo function inserts details of seo in database*************/
	public function addnewseo(){
		$user_type = $this->session->userdata('user_type');
		
		if($user_type == 'admin'){
					$permission=$this->check_permission_modules_core("SEO","all");
					$this->panels_check_permission($permission);
		}	
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		
		$CI =& get_instance();
		$this -> load -> helper('seo_content/seo_content');
		$this -> load -> model('seo_content/seo_content_model');
		
		$validation=seovalidation();
			if($validation){		
				$result=$this->seo_content_model->addseo();
				if($result!=0){
					$CI->session->set_flashdata('success_message', "SEO has been added Successfully");
					header("Location:" . $this -> config -> base_url() . "seo/view");
				
				}
				else{
					$CI->session->set_flashdata('error_message','SEO is not inserted');
					header("Location:" . $_SERVER['HTTP_REFERER']);
				}
			}
			else{
				$CI->session->set_flashdata('error_message','Form Validation error');
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}
	}
	/*****super_admin_view_all_seo function is used to view all the seos including search and pagination********/
	public function super_admin_view_all_seo(){
		$user_type = $this->session->userdata('user_type');
		$permission="";
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("SEO","view");
			$this->panels_check_permission($permission);
			$permission=$this->check_permission_modules_core("SEO","all");
		}	
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		
		$CI =& get_instance();
		$this -> load -> helper('seo_content/seo_content');
		$this -> load -> model('seo_content/seo_content_model');
		$this->load->library("pagination");
		$offset = ($this->uri->segment(3) != '' ? $this -> uri -> segment(3): 1);
		$per_page = 5;
		
		$totalAdmin=$this->seo_content_model->getallseocount();
			
		if($this->uri->slash_segment(2)=="search/"){
			$url= $this -> config -> base_url() ."seo/search"; 
    	}
    	else{
    		$url= $this -> config -> base_url() ."seo/view"; 
    	}	
		$pagination_detail = $this->pagination->pagination($totalAdmin, $per_page, $offset, $url);
		$data['paginglinks'] = $pagination_detail['paginationLinks'];
		$data['pagermessage'] = $pagination_detail ['paginationMessage'];
		
		$result=$this->seo_content_model->getallseos($offset,$per_page);

		$data['seos']=$result;
		$data['permission'] = $permission;
	
		$this->load->view($user_types.'_view_seo_content',$data);
	}
	
	/*****super_admin_edit_record function shows the view to edit seo*******/
	public function super_admin_edit_record(){
		$user_type = $this->session->userdata('user_type');
		
		if($user_type == 'admin'){
					$permission=$this->check_permission_modules_core("SEO","all");
					$this->panels_check_permission($permission);
		}	
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
	
		$CI =& get_instance();
		$this -> load -> helper('seo_content/seo_content');
		$this -> load -> model('seo_content/seo_content_model');
		
		$seo_id=$this->input->get('seoid');
		
		$result=$this->seo_content_model->getseobyid($seo_id);
		
		$data['result']=$result;
		$this->load->view($user_types.'_edit_seo_content',$data);
	}
	
	/***super_admin_update_seo function updates the details of seo in database****/
	public function super_admin_update_seo(){
		$user_type = $this->session->userdata('user_type');
		
		if($user_type == 'admin'){
					$permission=$this->check_permission_modules_core("SEO","all");
					$this->panels_check_permission($permission);
		}	
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		
		$CI =& get_instance();
		$this -> load -> helper('seo_content/seo_content');
		$this -> load -> model('seo_content/seo_content_model');
		
		$validation=editSeoValidation();
		if($validation){
			$seo_id=$this->input->post('edit_seo_id');
			
			$result=$this->seo_content_model->updateSeo($seo_id);
			
			if($result!=0){
				$CI->session->set_flashdata('success_message','SEO has been Update Successfully');
				header("Location:" . $this -> config -> base_url() . "seo/view");
			}else{
				$CI->session->set_flashdata('error_message','SEO is not Updated');
				header("Location:" . $_SERVER['HTTP_REFERER']);
	
			}
		}
		else{
			$CI->session->set_flashdata('error_message','From Validation Error');
			header("Location:" . $_SERVER['HTTP_REFERER']);
		}
	}
}