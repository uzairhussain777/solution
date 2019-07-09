<?php

class Template_content_model extends MY_Model {
	public function __construct() {
		parent::__construct("app_user");
	}
	
	public function addtemplate(){
		$templatename=$this->input->post("templatename");
		$templatesubject=$this->input->post("templatesubject");
		$templatetype=$this->input->post("templatetype");
		$templatetextbody=$this->input->post("templatetextbody");
		$templatehtmlbody=$this->input->post("templatehtmlbody");
		$fromname=$this->input->post("fromname");
		$fromemail=$this->input->post("fromemail");
		$logged_in_user_id=$this->session->userdata('user_id');
		
		$insert_in_template=array(
			'template_name'=>$templatename,
			'template_subject'=>$templatesubject,
			'template_type'=>$templatetype,
			'text_body'=>$templatetextbody,
			'html_body'=>$templatehtmlbody,
			'from_name'=>$fromname,
			'from_email'=>$fromemail,
			'date_created'=>date("Y-m-d H:i:s"),
			'created_by'=>$logged_in_user_id,
		);
		
		$result_inserted=$this->insert($insert_in_template,'email_template');
		// $CI =& get_instance();
		// $CI->session->set_flashdata('success_message', "Tempelate has been Created Successfully");

		return $result_inserted;
	}

	public function checkuniquetemplatename($templatename){
		$where = "template_name = '$templatename'";
		$result = $this->count($where,"email_template");
		return $result;
	}
	
	public function checkuniquetemplatenameforedit($templatename,$templateid){
		$where = "template_name = '$templatename' AND email_template_id != $templateid";
		$result = $this->count($where,"email_template");
		return $result;
	}
	
	public function getalltemplates($offset,$limit){
		$params=array(
		'Select'=>"email_template.*",
		'from'=> "email_template",
		"page" => $offset,
        "limit" => $limit
		);
		
		$result=$this->find($params);
		if($result !=null){
			return $result;
		}
		else{
			return false;
		}	
	}
	/******awais*****/
	public function getalltemplatesforsearch($offset,$limit){
		$params=array(
		'Select'=>"*",
		'from'=> "email_template",
		"page" => $offset,
        "limit" => $limit
		);
		$where="";
				/*******/
			if($this->uri->slash_segment(2)=="search/")
			 {
				if(!$_POST)
				{
					$temp_name_search= $this->session->userdata("temp_name");;
					$temp_subject_search= $this->session->userdata("temp_subject");
					$temp_from_name_search= $this->session->userdata("temp_from_name");
					$temp_from_email_search= $this->session->userdata("temp_from_email");	
				}else{
					$temp_name_search=$this->input->post("temp_name_search");
					$temp_subject_search=$this->input->post("temp_subject_search");
					$temp_from_name_search=$this->input->post("temp_from_name_search");
					$temp_from_email_search=$this->input->post("temp_from_email_search");
					
					$newdata = array(
						'temp_name'  => $temp_name_search,
						'temp_subject' => $temp_subject_search,
						'temp_from_name' => $temp_from_name_search,
						'temp_from_email' => $temp_from_email_search,	
					);
					$this->session->set_userdata($newdata);	}	
					$where_search = array();
					if(isset($temp_name_search) && $temp_name_search!=""){
						$where_search[] = "template_name like '%".$temp_name_search."%'";
					}
					if(isset($temp_subject_search) && $temp_subject_search!=""){
						$where_search[] = "template_subject like '%".$temp_subject_search."%'";
					}
					if(isset($temp_from_name_search) && $temp_from_name_search!=""){
						$where_search[] = "from_name like '".$temp_from_name_search."'";
					}
					if(isset($temp_from_email_search) && $temp_from_email_search!=""){
						$where_search[] = "from_email like '".$temp_from_email_search."'";
					}
				$where_search = implode(" and ", $where_search);
					if(strlen($where_search)){
						$where = $where_search;
					}
						
			}
			else{
				$this->session->unset_userdata("temp_name");
				$this->session->unset_userdata("temp_subject");
				$this->session->unset_userdata("temp_from_name)");
				$this->session->unset_userdata("temp_from_email)");	
			}
		/********/
		if(strlen($where)){
			$params['where']=$where;
		}
		$result=$this->find($params);
		if($result !=null){
			return $result;
		}
		else{
			return false;
		}			
}
	
	public function gettemplatebyid($template_id){
		$result_template = $this->findOneBy(array(
		"email_template_id" => $template_id
		),'email_template');
			
		return $result_template;
	}
	
	public function getconfirmationcodetemplate(){
		$result_template = $this->findOneBy(array(
		"template_subject" => "Confirmation Code"
		),'email_template');
			
		return $result_template;
	}
	
	public function verifyemailaddress(){
		$result_template = $this->findOneBy(array(
		"template_subject" => "Verify Email"
		),'email_template');
			
		return $result_template;
	}
	
	public function storyupdatesemail(){
		$result_template = $this->findOneBy(array(
		"template_subject" => "Story Updates"
		),'email_template');
			
		return $result_template;
	}
	
	public function updatetemplaterecord(){
		$templatename=$this->input->post("edit_templatename");
		$templatesubject=$this->input->post("edit_templatesubject");
		$templatetype=$this->input->post("edit_templatetype");
		$templatetextbody=$this->input->post("edit_templatetextbody");
		$templatehtmlbody=$this->input->post("edit_templatehtmlbody");
		$fromname=$this->input->post("edit_fromname");
		$fromemail=$this->input->post("edit_fromemail");
		$logged_in_user_id=$this->session->userdata('user_id');
		$template_id=$this->input->post("edit_templateid");
		
		$update=array(
			'template_name'=>$templatename,
			'template_subject'=>$templatesubject,
			'template_type'=>$templatetype,
			'text_body'=>$templatetextbody,
			'html_body'=>$templatehtmlbody,
			'from_name'=>$fromname,
			'from_email'=>$fromemail,
			'date_updated'=>date("Y-m-d H:i:s"),
			'created_by'=>$logged_in_user_id,
		);
		$result=$this->update($update,"email_template_id=$template_id","email_template");
		return true;
	}
	
	public function getalltemplatescount(){
		$params=array(
		'Select'=>"email_template.*",
		'from'=> "email_template",
		);
		$result=$this->find($params);
		if($result !=null){
			return count($result);
		}
		else{
			return false;
		}	
	}
	/********awais*******/
	public function getalltemplatescountforsearch(){
		$where="";
		if($this->uri->slash_segment(2)=="search/")
		{
			if(!$_POST)
			{
				$temp_name_search= $this->session->userdata("temp_name");;
				$temp_subject_search= $this->session->userdata("temp_subject");
				$temp_from_name_search= $this->session->userdata("temp_from_name");
				$temp_from_email_search= $this->session->userdata("temp_from_email");
				
			}else{
				$temp_name_search=$this->input->post("temp_name_search");
				$temp_subject_search=$this->input->post("temp_subject_search");
				$temp_from_name_search=$this->input->post("temp_from_name_search");
				$temp_from_email_search=$this->input->post("temp_from_email_search");
				
				$newdata = array(
					'temp_name'  => $temp_name_search,
					'temp_subject' => $temp_subject_search,
					'temp_from_name' => $temp_from_name_search,
					'temp_from_email' => $temp_from_email_search,	
				);
				$this->session->set_userdata($newdata);	}	
				$where_search = array();
			if(isset($temp_name_search) && $temp_name_search!=""){
				$where_search[] = "template_name like '%".$temp_name_search."%'";
			}
			if(isset($temp_subject_search) && $temp_subject_search!=""){
				$where_search[] = "template_subject like '".$temp_subject_search."'";
			}
			if(isset($temp_from_name_search) && $temp_from_name_search!=""){
				$where_search[] = "from_name like '".$temp_from_name_search."'";
			}
			if(isset($temp_from_email_search) && $temp_from_email_search!=""){
				$where_search[] = "from_email like '".$temp_from_email_search."'";
			}
			$where_search = implode(" and ", $where_search);
			
			if(strlen($where_search)){
				$where =$where_search;
				
			}
		}
		
		return $this->count($where,"email_template");
	}
}