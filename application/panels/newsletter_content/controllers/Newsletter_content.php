<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Newsletter_content extends MY_Controller {
	
	public function  __construct(){
		parent::__construct();
		
    }
	
	public function addnewsletter(){
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		$this -> load -> model('newsletter_content/newsletter_content_model');
		
		$data['result']=$this->newsletter_content_model->getalltemplates();
		$data['stories']=$this->newsletter_content_model->getallstories();
		$this->load->view($user_types.'_create_newsletter_form',$data);
	}
	 /*Rumman
    end of function addnewsletter this function to show the view of create newletter
    */
	
	public function addnewnewsletter(){
		$this -> load -> helper('newsletter_content/newsletter_content');
		$this -> load -> model('newsletter_content/newsletter_content_model');
		$validation=add_newsletter_validation();
		if($validation){
			$result=$this->newsletter_content_model->insertincronetable();
			if($result!=false){
				$this->session->set_flashdata('success_message','Newsletter has been Created Successfully');
				header("Location:" . $this -> config -> base_url() . "newsletter/view");
			}else{
				$this->session->set_flashdata('error_message','Newsletter is Not Created');
				header("Location:" . $this -> config -> base_url() . "newsletter/view");
			}
		}else{
			header("Location:" . $_SERVER['HTTP_REFERER']);
		}
		
	}
	 /*Rumman
    end of function addnewnewsletter this function to create newletter and insert the reord in the database
    */
	
	public function viewnewsletter(){
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		
		$this -> load -> model('newsletter_content/newsletter_content_model');
		$this->load->library("pagination");
		
		$offset = ($this->uri->segment(3) != '' ? $this -> uri -> segment(3): 1);
		$per_page = 5;
		
		$totalNewsletters=$this->newsletter_content_model->getallnewslettercountforsearch();
		
		 if($this->uri->slash_segment(2)=="search/"){
			$url= $this -> config -> base_url() ."newsletter/search";
		 }else{
    	 	$url= $this -> config -> base_url() ."newsletter/view";
    	 }
    	
		$pagination_detail = $this->pagination->pagination($totalNewsletters, $per_page, $offset, $url);
		$data['paginglinks'] = $pagination_detail['paginationLinks'];
		$data['pagermessage'] = $pagination_detail ['paginationMessage'];
		
		$newsletter=$this->newsletter_content_model->getAllRecordforsearch($offset,$per_page);
		if($newsletter!=0){
			$data['newsletter']=$newsletter;
			$this->load->view($user_types.'_view_newsletter',$data);
		}else{
			$this->load->view($user_types.'_view_newsletter',$data);
		}
	}
	 /*Rumman
    end of function viewnewsletter this function to view all the newsletter that are scheduled and draf ot canceled
    */

	public function editnewsletter(){
		$allowed_user_types=array(
			1=>'super_user',
			2=>'admin',
		);
		$user_types=$this->check_usertype_modules_core($allowed_user_types);
		
		$this -> load -> helper('newsletter_content/newsletter_content');
		$this -> load -> model('newsletter_content/newsletter_content_model');
		$newsletter_id=$this->input->get('newsletterid');
		
		$result=$this->newsletter_content_model->getnewsletterbyid($newsletter_id);
		$templates=$this->newsletter_content_model->getalltemplates();
		$stories=$this->newsletter_content_model->getallstories();
		if($result!=false){
			$data['result']=$result;
			$data['templates']=$templates;
			$data['stories']=$stories;
			$this->load->view($user_types.'_edit_newsletter_form',$data);
		}else{
			$CI->session->set_flashdata('error_message','Newsletter Record Not Found');
			header("Location:" . $_SERVER['HTTP_REFERER']);
		}
		
		//echo $newsletter_id;
	}
	 /*Rumman
    end of function editnewsletter to show the edit newsletter view on the admin panel
    */
	
	public function editnewsletterrecord(){
		$this -> load -> helper('newsletter_content/newsletter_content');
		$this -> load -> model('newsletter_content/newsletter_content_model');
		$validation=edit_newsletter_validation();
		if($validation){
			$newsletterid=$this->input->post('newletterid');
			$result=$this->newsletter_content_model->updatenewsletter($newsletterid);
			if($result!=false){
				$this->session->set_flashdata('success_message','Newsletter has been Updated Successfully');
				header("Location:" . $this -> config -> base_url() . "newsletter/view");
			}else{
				$this->session->set_flashdata('error_message','Newsletter has Not Updated');
				header("Location:" . $this -> config -> base_url() . "newsletter/view");
			}
		}else{
			$this->session->set_flashdata('error_message','Form Validation Error');
			header("Location:" . $_SERVER['HTTP_REFERER']);
		}
	}
	/*Rumman
    end of function editnewsletterrecord edit the record of the selected newsletter
    */

	public function cancelnewsletter(){
		$newsletter_id=$this->input->get('id');
		$this -> load -> model('newsletter_content/newsletter_content_model');
		$result=$this->newsletter_content_model->updatenewsletterstatus($newsletter_id);
		if($result!=false){
			$this->session->set_flashdata('success_message','Newsletter Canceled');
			header("Location:" . $this -> config -> base_url() . "newsletter/view");
		}
		else{
			$this->session->set_flashdata('error_message','Newsletter Not Canceled');
			header("Location:" . $this -> config -> base_url() . "newsletter/view");
		}
	}
	/*Rumman
    end of function cancelnewsletter to cancel the newsletter
    */

	public function deletenewsletter(){
		$newsletter_id=$this->input->get('id');
		$this -> load -> model('newsletter_content/newsletter_content_model');
		
		$result=$this->newsletter_content_model->deletenewsletter($newsletter_id);
		if($result!=false){
			$this->session->set_flashdata('success_message','Newsletter Deleted');
			header("Location:" . $this -> config -> base_url() . "newsletter/view");
		}
		else{
			$this->session->set_flashdata('error_message','Newsletter Not Deleted');
			header("Location:" . $this -> config -> base_url() . "newsletter/view");
		}
		
	}
	/*Rumman
    end of function deletenewsletter to delete the newsletter
    */
}