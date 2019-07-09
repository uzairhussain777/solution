<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Template_content extends MY_Controller {
	
	public function  __construct(){
		parent::__construct();
		
    }
	
	public function addtemplate(){
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		$this->load->view($user_types.'_create_template_form');
		
	}
	/*function to show the add template view in the admin panel */
	
	public function addnewtemplate(){
		$this -> load -> helper('template_content/template_content');
		$this -> load -> model('template_content/template_content_model');
		
		$validate=templatevalidation();
		if($validate){
			$result=$this->template_content_model->addtemplate();
			if($result!=0){
				$this->session->set_flashdata('success_message', "Tempelate has been Created Successfully");
				header("Location:" . $this -> config -> base_url() . "template/view");
			}else{
				$this->session->set_flashdata('error_message','Template is not inserted');
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}
		}else{
			$this->session->set_flashdata('error_message','Template Form validation error');
			header("Location:" . $_SERVER['HTTP_REFERER']);
		}
	}
	/*function to show the view of the add tempelete in admin panel*/
	
	public function viewtemplate(){		
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		
		$this -> load -> helper('template_content/template_content');
		$this -> load -> model('template_content/template_content_model');
		$this->load->library("pagination");
		
		$offset = ($this->uri->segment(3) != '' ? $this -> uri -> segment(3): 1);
		$per_page = 5;
		
		$totalTemplates=$this->template_content_model->getalltemplatescountforsearch();
		if($this->uri->slash_segment(2)=="search/"){
			$url= $this -> config -> base_url() ."template/search"; 
    	}else{
    		$url= $this -> config -> base_url() ."template/view"; 
    	}
		$pagination_detail = $this->pagination->pagination($totalTemplates, $per_page, $offset, $url);
		$data['paginglinks'] = $pagination_detail['paginationLinks'];
		$data['pagermessage'] = $pagination_detail ['paginationMessage'];
		
		$result=$this->template_content_model->getalltemplatesforsearch($offset,$per_page);
		//print_r($result);
		if($result!=0){
			$data['result']=$result;
			$this->load->view($user_types.'_view_template',$data);
		}else{
		//	$CI->session->set_flashdata('error_message','Record not found');
			$this->load->view($user_types.'_view_template');
		}
	}
	/*functio  to view all the templates in the admin panel*/
	
	public function edittemplates(){
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		
		$this -> load -> helper('template_content/template_content');
		$this -> load -> model('template_content/template_content_model');
		
		$template_id=$this->input->get('templateid');
		
		$result=$this->template_content_model->gettemplatebyid($template_id);
		
			if($result!=false){
				$data['result']=$result;
				$this->load->view($user_types.'_edit_template_form', $data);
			}
	}
	/*functio to show the view of the edit template */

	public function edittemplatetrecord(){
		$this -> load -> helper('template_content/template_content');
		$this -> load -> model('template_content/template_content_model');
		
		$validation=edittemplatevalidation();
		if($validation){
			$result=$this->template_content_model->updatetemplaterecord();
			if($result!=false){
				$this->session->set_flashdata('success_message','Temelate has been Updated Successfully');
				header("Location:" . $this -> config -> base_url() . "template/view");
			}else{
				$this->session->set_flashdata('error_message','Template Not Updated');
				header("Location:" . $_SERVER['HTTP_REFERER']);
			}
		}else{
			$this->session->set_flashdata('error_message','Form validation error');
			header("Location:" . $_SERVER['HTTP_REFERER']);
		}
	}
	/*function to edit the record of the template*/
}
	