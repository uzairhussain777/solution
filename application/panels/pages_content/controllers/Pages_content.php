<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pages_content extends MY_Controller {
	/*****page_Details function shows the content of Static Pages by picking from database ******/
	public function page_details(){
		//$CI =& get_instance();
		$slug = $this->input->get('content', TRUE);
		$this -> load -> model('pages_content/pages_content_model');
		$validation  = $this->pages_content_model->get_page_details($slug);
			
		if(!$validation){
			//$CI->session->set_flashdata('error_message','Page not Found');
			 $this->session->set_flashdata('flash_msg', "Page Not Found.");
			header("Location:" . $this -> config -> base_url() . "home");
			//show_404();
		}
		else{
			$validation->page_content= str_replace("%base_url%", base_url(), $validation->page_content);
			$data["validation"] = $validation;
			$this->load->view("pages_content",$data);
		}
	}
	/****super_user_add_pages_view function shows the view of adding new pages******/
		public function super_user_add_pages_view(){	
		$user_type = $this->session->userdata('user_type');
		
		if($user_type == 'admin'){
					$permission=$this->check_permission_modules_core("Pages","all");
					$this->panels_check_permission($permission);
		}	
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		//$user_types=$this->check_usertype_modules_core($allowed_user_types);
		$this->load->view($user_types.'_create_pages_content');
	}
	/*****addnewpage function inserts the page credentials in database*******/
	public function addnewpage(){
		$user_type = $this->session->userdata('user_type');
		
		if($user_type == 'admin'){
					$permission=$this->check_permission_modules_core("Pages","all");
					$this->panels_check_permission($permission);
		}	
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		//$user_types=$this->check_usertype_modules_core($allowed_user_types);
		
		$CI =& get_instance();
		$this -> load -> helper('pages_content/pages_content');
		$this -> load -> model('pages_content/pages_content_model');
		
		$validation=pagevalidation();
			if($validation){		
				$result=$this->pages_content_model->addpage();
				if($result!=0){
					$CI->session->set_flashdata('success_message', "Page has been added Successfully");
					header("Location:" . $this -> config -> base_url() . "pages/view");
				
				}
				else{
					$CI->session->set_flashdata('error_message','Page is not inserted');
					header("Location:" . $_SERVER['HTTP_REFERER']);
				}
			}
			else{
				$CI->session->set_flashdata('error_message','Form Validation error');
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}
	}	
	/******super_admin_view_all_pages function shows all the pages content including search and pagination***************/
	public function super_admin_view_all_pages(){
		$user_type = $this->session->userdata('user_type');
		$permission = "";
		if($user_type == 'admin'){
			$permission=$this->check_permission_modules_core("Pages","view");
			$this->panels_check_permission($permission);
			$permission=$this->check_permission_modules_core("Pages","all");
			
		}	
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
	//	$user_types=$this->check_usertype_modules_core($allowed_user_types);
		
		$CI =& get_instance();
		$this -> load -> helper('pages_content/pages_content');
		$this -> load -> model('pages_content/pages_content_model');
		$this->load->library("pagination");
		$offset = ($this->uri->segment(3) != '' ? $this -> uri -> segment(3): 1);
		$per_page = 5;
		
		$totalAdmin=$this->pages_content_model->getallpagecount();
			
		if($this->uri->slash_segment(2)=="search/"){
			$url= $this -> config -> base_url() ."pages/search"; 
    	}
    	else{
    		$url= $this -> config -> base_url() ."pages/view"; 
    	}	
		$pagination_detail = $this->pagination->pagination($totalAdmin, $per_page, $offset, $url);
		$data['paginglinks'] = $pagination_detail['paginationLinks'];
		$data['pagermessage'] = $pagination_detail ['paginationMessage'];
		
		$result=$this->pages_content_model->getallpages($offset,$per_page);

		$data['pages']=$result;
		$data['permission'] = $permission;
	
		$this->load->view($user_types.'_view_pages_content',$data);
	}
	/******super_admin_update_page function updates the credentials of a page********************/
	public function super_admin_update_page(){
		$user_type = $this->session->userdata('user_type');
		
		if($user_type == 'admin'){
					$permission=$this->check_permission_modules_core("Pages","all");
					$this->panels_check_permission($permission);
		}	
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		//$user_types=$this->check_usertype_modules_core($allowed_user_types);
		
		$CI =& get_instance();
		$this -> load -> helper('pages_content/pages_content');
		$this -> load -> model('pages_content/pages_content_model');
		
		$validation=editPageValidation();
		if($validation){
			$page_id=$this->input->post('edit_page_id');
			
			$result=$this->pages_content_model->updatePage($page_id);
			
			if($result!=0){
				$CI->session->set_flashdata('success_message','Page has been Updated Successfully');
				header("Location:" . $this -> config -> base_url() . "pages/view");
			}else{
				$CI->session->set_flashdata('error_message','Page is not Updated');
				header("Location:" . $_SERVER['HTTP_REFERER']);
	
			}
		}
		else{
			$CI->session->set_flashdata('error_message','From Validation Error');
			header("Location:" . $_SERVER['HTTP_REFERER']);
		}
	}
	
	/****super_admin_edit_record function shows the view for editing details of a page****************/
	public function super_admin_edit_record(){
		$user_type = $this->session->userdata('user_type');
		
		if($user_type == 'admin'){
					$permission=$this->check_permission_modules_core("Pages","all");
					$this->panels_check_permission($permission);
		}	
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		//$user_types=$this->check_usertype_modules_core($allowed_user_types);
	
		$CI =& get_instance();
		$this -> load -> helper('pages_content/pages_content');
		$this -> load -> model('pages_content/pages_content_model');
		
		$page_id=$this->input->get('pageid');
		
		$result=$this->pages_content_model->getpagebyid($page_id);
		
		$data['result']=$result;
		$this->load->view($user_types.'_edit_pages_content',$data);
	}
	
	/*******super_admin_delete_page function is used to delate the page from database*************/
	public function super_admin_delete_page(){
		$user_type = $this->session->userdata('user_type');
		
		if($user_type == 'admin'){
					$permission=$this->check_permission_modules_core("Pages","all");
					$this->panels_check_permission($permission);
		}	
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		//$user_types=$this->check_usertype_modules_core($allowed_user_types);
	
		$CI =& get_instance();
		$this -> load -> helper('pages_content/pages_content');
		$this -> load -> model('pages_content/pages_content_model');
	
		$result=$this->pages_content_model->super_admin_delete_page();
		if($result != 0){
			$CI->session->set_flashdata('success_message','Page Successfully Deleted');
			header("Location:" . $this -> config -> base_url() . "pages/view");
		}
		else{
			$CI->session->set_flashdata('error_message','Page is not Deleted');
			header("Location:" . $_SERVER['HTTP_REFERER']);
		}
	}

	
}
?>